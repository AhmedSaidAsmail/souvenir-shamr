<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/panel/login.css')}}">
    <title>C-Panel</title>
</head>
<body>
<div class="login-area">
    <h1>Login To Control Panel</h1>
    <form method="post" action="{{route('admin.login')}}">
        {{csrf_field()}}
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="email-addon">
                    <i class="fas fa-user"></i>
                </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="email@email.com" aria-label="email"
                       aria-describedby="email-addon">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="password-addon">
                    <i class="fas fa-unlock"></i>
                </span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="password"
                       aria-describedby="password-addon">
            </div>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button class="btn btn-secondary btn-block">
            <i class="fas fa-sign-in-alt"></i> Sight in
        </button>
    </form>
</div>
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>
</html>