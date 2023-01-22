@extends('app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Reset Password</h3>
                    @if(session('success'))
                    <p class="alert alert-success"> {{ session('success')}}</p>
                    @endif
                    @if($errors->any())
                    @foreach($errors->all() as $err)
                    <p class="alert alert-danger" role="alert">
                        {{ $err }}
                    </p>
                    @endforeach
                    @endif
                    <form method="POST" action="{{ route('password.action') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"> Old Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="old_password"
                                value="{{ old('old_password') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"> New Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="new_password"
                                value="{{ old('new_password') }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"> New Password Confirmation<span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                name="new_password_confirmation" value="{{ old('new_password_confirmation') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection