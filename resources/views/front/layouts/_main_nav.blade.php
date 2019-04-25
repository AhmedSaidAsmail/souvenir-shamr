<div class="main-nav">
    <div class="container">
        <ul class="nav">
            <li class="nav-item logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('images/logo.jpg')}}" alt="{{parse_url(request()->root())['host']}}">
                </a>
            </li>
            <li class="nav-item all-categories">
                <a href="" class="nav-link mob-menu-icon-wrapper">
                    <span>{{translate('All')}} <b>{{translate('Categories')}}</b></span>
                    <div class="mob-menu-icon">
                        <div class="hamburger"></div>
                    </div>
                </a>
            </li>
            @foreach($sections as $section)
                <li class="nav-item">
                    <?php
                    $section_parameters = [
                        'lang' => $lang,
                        'section_name' => translateModel($section, 'name'),
                        'id' => $section->id];
                    ?>
                    <a href="{{route('home.section',$section_parameters)}}" class="nav-link">
                        {{translateModel($section,'name')}}
                    </a>
                </li>
            @endforeach
            <li class="nav-item mob-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('images/logo.jpg')}}" alt="{{parse_url(request()->root())['host']}}">
                </a>
            </li>
        </ul>
    </div>
</div>