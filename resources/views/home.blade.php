@extends('app')
@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3>Welcome, <i>{{ Auth::user()->username }}</i></h3>
                    <a class="btn btn-primary" href="{{ route('password') }}">Reset Password</a>
                    <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3>Hello</h3>
                    <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-info" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection