<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/customer/auth.css')}}" type="text/css" rel="stylesheet">
    <title>Souvenir Sharm Sign In</title>
</head>
<body>
<div class="auth-container">
    <a href="{{route('home')}}">
        <img src="{{asset('images/logo.jpg')}}">
    </a>
    <div class="form-container">
        <h2>Sign in</h2>
        <form method="post" action="{{route('customer.login')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="">
            </div>
            <div class="form-group">
                <label>Password</label>
                <a href="#" class="forget-password">Forgot your password?</a>
                <input type="password" class="form-control" name="password" value="">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Keep me signed in
                </label>
            </div>
            <button class="btn btn-warning btn-block">Sign in</button>
            <span class="notification">
            By continuing, you agree to Souvenir Sharm's
            <a href="">Conditions of Use</a> and <a href="">Privacy Notice</a> .
        </span>
        </form>
        <div class="new-to-wrapper">
            <span class="new-to">New to Souvenir Sharm?</span>
        </div>
        <a href="{{route('customer.register')}}" class="btn btn-block btn-light">Create your new account</a>
        <a class="btn btn-block btn-sp-facebook" href="">
            <i class="fab fa-facebook-f"></i> Sign in with Facebook
        </a>
    </div>
</div>
</body>
</html>