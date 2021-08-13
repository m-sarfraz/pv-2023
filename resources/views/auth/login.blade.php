@extends('layouts.auth-app')
@section('content')
    <div class="loginpageS d-flex flex-wrap w-100">
        <div class="col-lg-6 bg-white">
            <form class="loginForm">
                <div class="d-flex justify-content-center pb-2">
                    <img style="width: 25px;" src="{{'assets/loginIcon.png'}}" alt="" />
                </div>
                <div class="form-group">
                    <label class="mb-0 d-block font-size-3 mb-1">
                        Email
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                        <span class="input-group-text EmailIcon" id="inputGroupPrepend2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"
                                                />
                                            </svg>
                                        </span>
                        </div>
                        <input class="form-control EmailInput-F" id="email" name="email" placeholder="Enter Email Address" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="mb-1 d-block font-size-3">
                        Password
                    </label>
                    <input type="password" class="form-control EmailInput-F" name="password" />
                </div>
                <div class="form-group">
                    <a class="font-size-3 text-dodger line-height-reset">
                        Forget Password
                    </a>
                </div>
                <div class="d-flex justify-content-center">
                    <button style="background-color: #dc8627;" type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-6 loginLogo">
            <div class="d-flex justify-content-center">
                <img style="width: 249px;" src="{{ 'assets/LoginForm.png' }}" alt="" />
            </div>
            <div class="d-flex justify-content-center" style="padding-top: 159px;">
                <h5 style="color: white; font-size: 28px;">
                    Welcome to
                </h5>
            </div>
            <div class="d-flex justify-content-center">
                <h5 style="color: white; font-size: 65px;">
                    Eallaine
                </h5>
            </div>
        </div>
    </div>
@endsection
