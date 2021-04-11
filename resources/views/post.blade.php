@extends('layout')

@section('title', 'InstaApp | Post')
@section('content')
<div class="row justify-content-center m-4">
      <div class="col-md-8">
         <div class="row">
            <div class="col-md-7 post-image">
               <img src="{{ asset('storage/' . $post['image']) }}" width="100%" alt="">
            </div>
            <div class="col-md-5">
               @if ($user['avatar'] == 'NO IMAGE')
                  <img class="img-circle" src="{{ asset('img/avatar.png') }}" style="width: 130px; height: 130px" alt="User Avatar">

               @else
                  <img src="{{ asset('storage/' . $user['avatar']) }}" class="img-circle elevation-2" style="width: 130px; height: 130px"  alt="">               
               @endif

               <a href="#" style="color: black">
                  <span class="font-size-13 ml-2">
                     {{ $user['username'] }}
                  </span>
               </a>
               
               <hr>

               <div class="content-body p-2" >
                  <span>{{ $post['content'] }}</span>
                  
                  @if (!$comments->isEmpty())
                     @foreach ($comments as $comment)
                        <div class="card-footer card-comments mt-2 pl-3 pr-3 pt-2 pb-1">
                           <div class="card-comment">
                              <!-- User image -->
                              @if ($comment->users->avatar == 'NO IMAGE')
                                 <img class="img-circle img-sm pull-left" src="{{ asset('img/avatar.png') }}">

                              @else
                                 <img src="{{ asset('storage/' . $comment->users->avatar) }}" class="img-circle img-sm pull-left">               
                              @endif
                              <!-- Komentar -->
                              <div class="comment-text">
                                 <span class="username">
                                    <a href="#">
                                       {{ $comment->users->fullname }}
                                    </a>
                                    <span class="text-muted float-right">{{ date('d/m/Y', strtotime($comment->created_at)) }}
                                       @if ($comment->user_id == \Auth::user()->id)
                                          <span class="delete-comment text-muted float-right">
                                             <i class="fas fa-trash-alt"></i>
                                             <a href="{{ route('deletecomment', $comment->id) }}">Hapus</a>
                                          </span>
                                       @endif
                                    </span>
                                 </span>
                                 <p class="col-sm-12">
                                    {{ $comment->comment }}
                                 </p>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  @endif
               </div>

               <div class="card-footer pl-1 pr-1 pb-1 pt-0">
               <div class="like-content">
                     <button id="like" class="btn border-0 btn-sm mt-1 {{ \Auth::user()->hasLiked($post) ? ' like-post' : '' }}">
                        @if (\Auth::user()->hasLiked($post))
                           <span class="fas fa-thumbs-down"></span> Tidak Disukai
                        @else
                           <span class="fas fa-thumbs-up"></span> Disukai
                        @endif
                     </button>
                     <small class="float-right text-muted" ><span id="like-count">{{ $post->likers()->count() }}</span> suka</small>
                  <form action="{{ route('addcomment') }}" method="post">
                     @csrf
                     <div class="row justify-content-center">
                        <div class="col-md-10">
                           <input type="text" placeholder="Tambahkan komentar..." class="input-comment form-control" name="comment" id="" required/>
                           <input type="hidden" name="post_id" id="post_id" value="{{ $post['id'] }}">
                        </div>
                        <div class="col-md-2 p-0 text-center">
                           <button type="submit" class="btn-kirim-komentar btn btn-primary" href="#">Kirim</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('js')
<script>
   $(document).ready(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

      $('#like').click(function() {
         var post_id = $('#post_id').val();
         var like_count = $('#like-count').text();
         var cObj = $(this);

         $.ajax({
            type:'POST',
            url:'/addlike',
            data:{id:post_id},
            success:function(data) {
               if($(cObj).hasClass("like-post")){
                  $('#like-count').text(parseInt(like_count) - 1);
                  $('#like').html('<span class="fas fa-thumbs-up"></span> Disukai');
                  $(cObj).removeClass("like-post");

               } else {
                  $('#like-count').text(parseInt(like_count) + 1);
                  $('#like').html('<span class="fas fa-thumbs-down"></span> Tidak Disukai');
                  $(cObj).addClass("like-post");
               }
            }
         });
      });
   });
</script>
@endpush