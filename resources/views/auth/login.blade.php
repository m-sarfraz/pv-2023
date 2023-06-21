@extends('layouts.auth-app')
@section('content')
    <div class="col-lg-6 bg-white ">
        <form class="loginForm mt-0 pt-5" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="d-flex justify-content-center pb-2 mt-0 pt-2">
                <img src="{{ 'assets/image/login/VCC_Logo_Horizontal.png' }}" style="width:80%" alt="" />
            </div>
            <div class="form-group mb-4">
                @if (session('status_error'))
                    <div class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                          </svg> {{ session('status_error') }}
                    </div>
                @endif
                @if (session('auth_error'))
                    <div class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                          </svg>  {{ session('auth_error') }}
                    </div>
                @endif
                <label class="mb-0 d-block font-size-3 mb-1">
                    Email Address
                </label>
                <div class="input-group">

                    <input class="form-control EmailInput-F @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required />
                    
                </div>
            </div>
            <div class="form-group mb-4">
                <label class="mb-1 d-block font-size-3">
                    Password
                </label>
                <input type="password" placeholder="Enter Password"
                    class="form-control EmailInput-F @error('password') is-invalid @enderror" name="password" required />
               
            </div>
            <div class="form-group text-center mb-4">
                <a href="{{ route('password.request') }}" style="font-size: 15px"
                    class="font-size-3  text-dodger line-height-reset">
                    Forgot Password
                </a>
            </div>
            <div class="d-flex justify-content-center">
                <button style="background-color: #dc8627;width:100%;border-radius: 25px;font-weight: bold;" type="submit"
                    class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>
@endsection
