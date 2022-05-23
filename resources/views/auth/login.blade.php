@extends('layouts.auth-app')
@section('content')
<div class="col-lg-6 bg-white ">
    <form class="loginForm mt-0 pt-5" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="d-flex justify-content-center pb-2 mt-0 pt-2">
            <img  src="{{'assets/image/login/VCC_Logo_Horizontal.png'}}" style="width:80%" alt="" />
        </div>
        <div class="form-group mb-4">
            <label class="mb-0 d-block font-size-3 mb-1">
                Email Address
            </label>
            <div class="input-group">
             
                <input class="form-control EmailInput-F @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="mb-1 d-block font-size-3">
                Password
            </label>
            <input type="password" placeholder="Enter Password" class="form-control EmailInput-F @error('password') is-invalid @enderror" name="password" required/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group text-center mb-4">
            <a href="{{ route('password.request') }}" style="font-size: 15px" class="font-size-3  text-dodger line-height-reset">
                Forgot Password
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <button style="background-color: #dc8627;width:100%;border-radius: 25px;font-weight: bold;" type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
</div>
@endsection
