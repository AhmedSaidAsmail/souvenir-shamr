<div class="side-menu">
    <ul>
        <li>
            <a href="">{{translate('home')}}</a>
        </li>
        @foreach($sideSections as $section)
            <li class="menu-item">
                <a href="" class="have-sub">{{$section->en_name}}</a>
                <ul class="sub-menu">
                    <li>
                        <a href="">Gift Sets</a>
                    </li>
                    <li>
                        <a href="">Perfume For Her</a>
                    </li>
                    <li>
                        <a href="">Perfume For Him</a>
                    </li>
                    <li>
                        <a href="">Make up</a>
                    </li>
                    <li>
                        <a href="">Bath & Body</a>
                    </li>
                    <li>
                        <a href="">Gift Sets</a>
                    </li>
                    <li>
                        <a href="">Perfume For Her</a>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>
    <div class="languages">
        <h2>Languages</h2>
        <ul class="nav">
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="images/en-flag.jpg">
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="images/eg-flag.jpg">
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="images/ru-flag.jpg">
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="images/it-flag.jpg">
                </a>
            </li>
        </ul>
    </div>
</div>
@section('javascript')
    @parent
    <script>
        $("a.mob-menu-icon-wrapper").click(function (event) {
            event.preventDefault();
            var icon = $(this).find('.mob-menu-icon');
            if (!icon.hasClass('lunched')) {
                icon.addClass('lunched');
                sideMenu(true);
                return true;
            }
            icon.removeClass('lunched');
            sideMenu(false);
        });

        function sideMenu(is_lunched) {
            var parent = $(".body-wrapper");
            var mainNav = $(".main-nav");
            if (is_lunched) {
                parent.addClass('lunched');
                mainNav.addClass('lunched');
            } else {
                parent.removeClass('lunched');
                mainNav.removeClass('lunched');
            }
        }
    </script>
    <script>
        $("li.menu-item > a").click(function (event) {
            event.preventDefault();
            var parent = $(this).closest('li');
            var submenu = parent.find('ul.sub-menu');
            if (submenu.length) {
                if (!parent.hasClass('lunched')) {
                    parent.addClass('lunched');
                    return true;
                }
                parent.removeClass('lunched');
            }
        });
    </script>
@endsection