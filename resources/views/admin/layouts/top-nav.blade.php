<div class="top-nav row">
    <div class="col-md-2 logo">
        <a href="">
            <img src="{{asset('images/panel/logo.png')}}">
        </a>
        <a class="nav-field sidebar-toggle">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="col-md-6 page-title text-center">
        SharmSouvenir-Dashboard
    </div>
    <div class="col-md-4 text-right nav-right">
        <a href="" class="nav-field">
            <i class="fas fa-bell"></i>
        </a>
        <a href="" class="nav-field active">
            <span>{{auth()->guard('web')->user()->name}}</span>
            <i class="fas fa-user-circle"></i>
        </a>
        <a href="#" class="nav-field fullscreen" title="full screen mode">
            <i class="fas fa-desktop"></i>
        </a>
        <a class="nav-field" href="{{route('admin.logout')}}" title="logout">
            <i class="fas fa-power-off"></i>
        </a>
        <a class="nav-field">
            <i class="fas fa-cog"></i>
        </a>
    </div>
</div>
@section('top-nav-js')
    @parent
    <script>
        $("a.fullscreen").click(function (event) {
            event.preventDefault();
            var elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        });
    </script>
@endsection