@extends('app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Registration</h3>
                    @if($errors->any())
                    @foreach($errors->all() as $err)
                    <p class="alert alert-danger" role="alert">
                        {{ $err }}
                    </p>
                    @endforeach
                    @endif
                    <form method="POST" action="{{ route('register.action') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                value="{{ old('password') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Password Confirmation <span s
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection