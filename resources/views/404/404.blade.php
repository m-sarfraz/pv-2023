@extends('layouts.auth-app')

<style>
    .sadimage {
    width: 100px;
    margin: auto;
}
h3.headline {
    font-size: 200px;
    font-weight: 800;
    line-height: 1;
    color:rgb(220, 134, 39);
}
.errow_wrap p {
    font-size: 18px;
    letter-spacing: 1px;
    color: #000;
    font-weight: 400;
    /* margin-top: 30px; */
    /* line-height: 35px; */
}

.default_btn {
    display: inline-block;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    background: rgb(220, 134, 39);
    transition: .3s;
    padding: 15px 25px;
    border-radius: 3px;
}
</style>
@section('content')
    <div class="loginpageS1 d-flex flex-wrap w-100">
    <div class="container text-center">
            <img src="{{'assets/image/login/sad.png'}}" class="sadimage" alt="" style="
">
            <div class="error_heading py-3  text-center">
                <h3 class="headline font-danger theme_color_6 m-0">404</h3>
            </div>
            <div class="col-md-8 offset-md-2 text-center errow_wrap">
                <p class="m-0">The page you are attempting to reach is currently not available. This may be because the page does not exist or has been moved.</p>
            </div>
            <div class="error_btn  text-center pt-4">
                <a class=" default_btn theme_bg_6 px-5" href="index.html">Back Home</a>
            </div>
        </div>
    </div>
@endsection
