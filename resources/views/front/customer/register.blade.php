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
        <h2>Create account</h2>
        <form method="post" action="{{route('customer.register')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label>Your name</label>
                <input class="form-control" name="name" value="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="" placeholder="At least 6 characters">
                <span>
                    Passwords must be at least 6 characters.
                </span>
            </div>
            <div class="form-group">
                <label>Re-enter password</label>
                <input type="password" class="form-control" name="password_confirmation" value="">
            </div>
            <button class="btn btn-warning btn-block">Create your new account</button>
            <span class="notification">
            By continuing, you agree to Souvenir Sharm's
            <a href="">Conditions of Use</a> and <a href="">Privacy Notice</a> .
        </span>
        </form>
    </div>
</div>
</body>
</html>