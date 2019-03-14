<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/panel/main.css')}}">
    @yield('css')
    <title>C-Panel</title>
</head>
<body>
@include('admin.layouts.top-nav')
<div class="monitor-screen row">
    @include('admin.layouts.main-nav')
    @yield('content')
</div>
<div class="footer">
    <span class="copy-rights">Copyright © 2019</span>
    <a href="mailto:info.matrixcode@gmail.com">Matrix Code Micro Systems</a> . All rights reserved.
</div>
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
@yield('top-nav-js')
@yield('javascript')
<script>
    $("a.sidebar-toggle").click(function (event) {
        event.preventDefault();
        var nav = $("div.main-nav");
        var monitor = $("div.main-interface");
        if (!nav.hasClass('hidden')) {
            nav.addClass('hidden');
            monitor.removeClass('col-md-10');
            monitor.removeClass('offset-md-2');
            monitor.addClass('col-md-12');
            return true;
        }
        nav.removeClass('hidden');
        monitor.removeClass('col-md-12');
        monitor.addClass('col-md-10');
        monitor.addClass('offset-md-2');
    })
</script>
</body>
</html>