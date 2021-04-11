<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Support\Facades\Storage;
use Validator;
  
class HomeController extends Controller
{
    public function index()
    {
        $username="rofiq@gmail.com";
        $posts = Posts::whereHas('users', function($query) use ($username) {
            return $query->where('email', '=', $username);
        })->get();
        $user = User::where('email', '=', $username)->first();
         return view('home', ['user'=>$user, 'posts'=>$posts]);
    }
    public function addPost(Request $request)
    {
        $post = new Posts();

        $post->user_id = \Auth::user()->id;
        $post->content = $request->get('caption');

        $image = $request->file('image');

        if ($image) {
            $cover_path = uploadOriginalImage($image, \Auth::user()->username, 'posts');
            $post->image = $cover_path;
        }

        $post->save();
        return redirect()->route('home', \Auth::user()->username)->with('success', 'Berhasil menambahkan postingan baru');
    }
    public function post(Request $request,$id)
    {
        // Mengambil berdasarkan username profil dan id post
        $post = Posts::whereHas('users')->where('id', '=', $id)->get()->first();
        $user = auth()->user();
        // // pengguna
        $user = User::where('id', '=',  $user->id)->first();
        // // Komentar
        $comments = Comments::with(['users', 'posts'])
            ->where('user_id', '=', $user['id'])
            ->where('post_id', '=', $id)
            ->get();
        return view('post', compact('user', 'post', 'comments'));
    }
    public function addLike(Request $request) {

        $post = Posts::find($request->id);
         $response = \Auth::user()->toggleLike($post);
         return response()->json(['success' => $response]);
    }
    public function addComment(Request $request)
    {
        $comment = new Comments();

        $comment->user_id = \Auth::user()->id;
        $comment->post_id = $request->get('post_id');

        if ($request->get('status')) {
            $comment->comment = $request->get('comment' . $request->get('post_id'));

        } else {
            $comment->comment = $request->get('comment');
        }

        $comment->save();

        return redirect()->back();
    }

    public function deleteComment($id)
    {
        $comment = Comments::findOrFail($id);

        // dd($comment);
        $comment->delete();

        return redirect()->back();
    }
}