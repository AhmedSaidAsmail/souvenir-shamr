<div class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-3 left-nav">
                <ul class="nav">
                    <li class="nav-item"><i class="fas fa-shipping-fast"></i> {{translate('Fast shipping')}}</li>
                    <li class="nav-item"><i class="fas fa-sync-alt"></i> {{translate('Free return')}}</li>
                    <li class="nav-item">
                        <a href="">
                            <i class="far fa-question-circle"></i> Help
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-md-6 search-nav">
                <input class="form-control" placeholder="{{translate('What are looking for?')}}">
                <button><i class="icon ion-md-search"></i></button>
            </div>
            <div class="col-md-3 right-nav">
                <ul class="nav justify-content-end">
                    @if(!auth()->guard('customer')->check())
                        <li class="nav-item">
                            <a href="#" class="drop-down-link">
                                {{translate('Languages')}} <i class="icon ion-md-arrow-dropdown"></i>
                            </a>
                            <div class="drop-down-wrapper top-languages">
                                <a href="{{route('home.change.lang',['lang'=>'en'])}}">
                                    <img src="{{asset('images/en-flag.jpg')}}">
                                    {{translate('english')}}
                                </a>
                                <a href="{{route('home.change.lang',['lang'=>'ar'])}}">
                                    <img src="{{asset('images/eg-flag.jpg')}}">
                                    {{translate('العربية')}}
                                </a>
                                <a href="{{route('home.change.lang',['lang'=>'ru'])}}">
                                    <img src="{{asset('images/ru-flag.jpg')}}">
                                    {{translate('русский')}}
                                </a>
                                <a href="{{route('home.change.lang',['lang'=>'it'])}}">
                                    <img src="{{asset('images/it-flag.jpg')}}">
                                    {{translate('italiano')}}
                                </a>
                            </div>
                        </li>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <li class="nav-item">
                            <a href="#" class="drop-down-link customer-name">
                                {{translate('Hello')}}, {{auth()->guard('customer')->user()->name}}
                                <i class="icon ion-md-arrow-dropdown"></i>
                            </a>
                            <div class="drop-down-wrapper top-customer">
                                <ul>
                                    <li>
                                        <a href="{{route('customer.logout')}}">
                                            <i class="fas fa-sign-out-alt"></i> {{translate('Sign out')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="drop-down-link">
                                {{translate('Sign In')}}<i class="icon ion-md-arrow-dropdown"></i>
                            </a>
                            <div class="drop-down-wrapper top-sign-in">
                                <a href="{{route('customer.login')}}" class="btn btn-primary btn-block">Log In</a>
                                <span>Don't have an account?</span>
                                <a href="{{route('customer.register')}}">Sign Up</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item shopping-cart">
                        <a href="{{route('cart.index',['lang' => $lang])}}">
                            <div class="cart-badge">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span class="number">{{cart()->count()}}</span>
                            <span>{{translate('cart')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    @parent
    <script>
        $("a.drop-down-link").click(function (event) {
            event.preventDefault();
            var li = $(this).closest('li');
            var allLi = $(this).closest('li').closest('ul').find('li');
            if (li.hasClass('active')) {
                allLi.removeClass('active');
                return true;
            }
            allLi.removeClass('active');
            li.addClass('active');
        });
    </script>
@endsection