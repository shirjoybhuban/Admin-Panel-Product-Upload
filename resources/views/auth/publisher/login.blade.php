<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport"
          content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
    <title>Publisher Login</title>
    <style>
        .body{
            background: linear-gradient(0deg, rgb(68, 160, 241) 0%, rgb(34, 63, 169) 100%);
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }
        .wrap-login {

            box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        }
        .header{
            color:#444;
            text-align: center;
        }
        .left-bar{
            border-left: 2px solid #ccc;

        }
        .log-form{
            padding: 30px;
            box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    {{--toastr js--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
<div class="container-fluid body">
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12 ">--}}
    {{--            <h1 class="header">Admin Login</h1>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="row ">
        <div class="col-md-12 text-center ">
            <a href = "#"><img src = "{{asset('/frontend/img/home/logo_large.png')}}" alt = "" width="150px" hieght="150px"></a>
            <h3 class="font-weight-bold mb-4 text-white">Publisher Login</h3>
        </div>
        <div class="col-md-12">
            <div class="log-form card">
                <form class="form-horizontal" method="post" role="form" action="{{ route('publisher.login.check') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        {{--                        <label for="exampleInputPassword1">Password</label>--}}
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    {{--<div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>--}}
                    <br>
                    <button style="background: linear-gradient(0deg, rgb(68,85,241) 0%, rgb(28,108,229) 100%);color:black;border:0px;" type="submit" class="btn btn-secondary w-100 font-weight-bold text-white">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error )
    toastr.error('{{$error}}','Error',{
        closeButton:true,
        progressBar:true
    });
    @endforeach
    @endif
</script>
</body>
</html>
