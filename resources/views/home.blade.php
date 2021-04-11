@extends('layout')

@section('title', 'InstaApp | Profil')
@section('content')
<div class="container">
   <!--Foto profil & Nama-->
   <div class="row justify-content-center">
      <div class="col-md-8 m-4">
         <div class="row">
            <div class="col-md-4 text-center">
               @if ($user['avatar'] == 'NO IMAGE')
                  <img class="img-circle" src="{{ asset('img/avatar.png') }}" style="width: 130px; height: 130px" alt="User Avatar">

               @else
                  <img src="{{ asset('storage/' . $user['avatar']) }}" class="img-circle elevation-2" style="width: 130px; height: 130px"  alt="">               
               @endif
            </div>
            <div class="col-md-8">
               <h4 class="d-inline">{{ $user['fullname'] }}</h4>
               <h5>({{ $user['username'] }})</h5>
               <small>{{ $user['email'] }}</small>
               <p><small>{{ $user['bio'] }}</small></p>
               <div class="col-sm-12" role="group" aria-label="Basic example">
                  <button class="btn btn-sm btn-edit-profil btn-secondary col-sm-12" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     <i class="fa fa-plus-square"></i>  Tambah Postingan</button>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row justify-content-center">
      <div class="col-md-8 m-4">
         <div class="row">
            @if (!$posts->isEmpty())
               @foreach ($posts as $post)
                  <div class="col-md-4">
                     <a href="{{ route('home.post_detail', ['id' => $post->id]) }}">
                        <div class="card">
                           <div class="posts">
                              <img src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail" alt="">
                           </div>
                        </div>
                     </a>
                  </div>
               @endforeach
            
            @else
               <div class="col-md-12 text-center">
                  <small class="text-muted">Tidak ada data</small>
               </div>
            @endif
         </div>
      </div>
   </div>
   @include('addpost')
</div>
@endsection

@push('js')
   <script>
      
      
   </script>
@endpush