<div class="side-menu">
    <ul>
        <li>
            <a href="">{{translate('home')}}</a>
        </li>
        @foreach($sideSections as $section)
            <li class="menu-item">
                <?php
                $hasCategories = !empty($section->confirmedCategories()) ? true : false;
                $section_parameters = [
                    'lang' => $lang,
                    'section_name' => translateModel($section, 'name'),
                    'id' => $section->id];
                ?>
                <a href="{{route('home.section',$section_parameters)}}" {!! $hasCategories?'class="have-sub"':null !!}>
                    {{translateModel($section,'name')}}
                </a>
                @if($categories=$section->confirmedCategories())
                    <ul class="sub-menu">
                        @foreach($categories as $category)
                            <?php
                            $category_parameters = [
                                'lang' => $lang,
                                'category_name' => translateModel($category, 'name'),
                                'id' => $category->id
                            ]
                            ?>
                            <li>
                                <a href="{{route('home.category',$category_parameters)}}">{{translateModel($category,'name')}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="languages">
        <h2>Languages</h2>
        <ul class="nav">
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="{{asset('images/en-flag.jpg')}}">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('home.change.lang',['lang'=>'ar'])}}" class="nav-link">
                    <img src="{{asset('images/eg-flag.jpg')}}">
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="{{asset('images/ru-flag.jpg')}}">
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <img src="{{asset('images/it-flag.jpg')}}">
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