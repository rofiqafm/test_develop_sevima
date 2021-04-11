@extends('auth.auth')

@section('title', "Login")
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Form Login</h3>
    </div>
    <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="card-body">
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Something it's wrong:
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="form-group">
            <label for=""><strong>Email</strong></label>
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for=""><strong>Password</strong></label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-block">Log In</button>
        <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Register</a> sekarang!</p>
    </div>
    </form>
</div>
@endsection