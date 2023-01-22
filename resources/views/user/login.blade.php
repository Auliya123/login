@extends('app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="text-center">Login</h3>
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
                    <form method="POST" action="{{ route('login.action') }}">
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
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-warning reload" id="reload">&#x21bb;</button>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" id="captcha"
                                    class="form-control form-control-user @error('captcha') is-invalid @enderror"
                                    placeholder="masukan captcha" name="captcha" data-validation="required">
                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#reload').click(() => {
    $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: (data) => {
            $(".captcha span").html(data.captcha)
        }
    })
})
</script>
@endsection