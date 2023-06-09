<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Ropa Sans', sans-serif;
            /* margin-top: 30px; */
            /* background-color: #F0CA00; */
            /* background-color: #F3661C; */
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .error-heading {
            margin: 50px auto;
            width: 250px;
            border: 5px solid rgb(0, 0, 0);
            font-size: 126px;
            line-height: 126px;
            border-radius: 30px;
            text-shadow: 6px 6px 5px rgb(255, 255, 255);
        }

        .error-heading img {
            width: 100%;
        }

        .error-main h1 {
            font-size: 72px;
            margin: 0px;
            color: #F3661C;
            text-shadow: 0px 0px 5px rgb(0, 0, 0);
        }

    </style>
</head>

<body>

    <div class="error-main">
        <h1>Oops!</h1>
        <div class="error-heading">403</div>
        <p>Access not granted to your account, contact admin if needed</p>
    </div>
    <a type="button" href="{{url('/')}}" class="btn btn-success mt-5 btn-md">Go Home</a>
</html>
