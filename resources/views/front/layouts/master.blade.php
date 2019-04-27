<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
    @yield('css')
</head>
<body>
<div class="body-wrapper">
    @include('front.layouts._side_nav')
    <div class="content-wrapper">
        <header>
            @include('front.layouts._top_nav')
            @include('front.layouts._main_nav')
        </header>
        @yield('banner')
        @yield('content')
        <div class="footer">
            <div class="container">
                <div class="footer-links-wrapper row">
                    <div class="footer-links col-md-3">
                        <h3>Get to Know Us</h3>
                        <ul>
                            <li>
                                <a href="" class="nav_a">Careers</a>
                            </li>
                            <li>
                                <a href="">Blog</a>
                            </li>
                            <li>
                                <a href="">About SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Investor Relations</a>
                            </li>
                            <li>
                                <a href="">SouvenirSharm Devices</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>Make Money with Us</h3>
                        <ul>
                            <li>
                                <a href="">Sell on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Sell Your Services on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Sell on SouvenirSharm Business</a>
                            </li>
                            <li>
                                <a href="">Sell Your Apps on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Become an Affiliate</a>
                            </li>
                            <li>
                                <a href="">Advertise Your Products</a>
                            </li>
                            <li>
                                <a href="">Self-Publish with Us</a>
                            </li>
                            <li>
                                <a href="">See all</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>SouvenirSharm Payment Products</h3>
                        <ul>
                            <li>
                                <a href="">SouvenirSharm Business Card</a>
                            </li>
                            <li>
                                <a href="">Shop with Points</a>
                            </li>
                            <li>
                                <a href="">Reload Your Balance</a>
                            </li>
                            <li>
                                <a href="">SouvenirSharm Currency Converter</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>Let Us Help You</h3>
                        <ul>
                            <li>
                                <a href="">Your Account</a>
                            </li>
                            <li>
                                <a href="">Your Orders</a>
                            </li>
                            <li>
                                <a href="">Shipping Rates & Policies</a>
                            </li>
                            <li>
                                <a href="">Returns & Replacements</a>
                            </li>
                            <li>
                                <a href="">Manage Your Content and Devices</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-ref">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 social-media text-center">
                            <span>follow us on</span>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="col-md-4 languages text-center">
                            <span>languages</span>
                            <a href=""><img src="images/en-flag.jpg"> </a>
                            <a href=""><img src="images/eg-flag.jpg"> </a>
                            <a href=""><img src="images/ru-flag.jpg"> </a>
                            <a href=""><img src="images/it-flag.jpg"> </a>
                        </div>
                        <div class="col-md-4 payment-methods text-center">
                            <span>payment methods</span>
                            <i class="fas fa-money-bill-wave"></i>
                            <i class="fab fa-paypal"></i>
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copy-rights text-center">
                &copy; 2019 souvenirsharm.com, powered py <a href="mailto:info.matrixcode@gmail.com"> Matrix Code</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@yield('javascript')
<script>
    // scroll list
    $(".list-control-next").click(function () {
        var parent = $(this).closest('.products-list-wrapper');
        var list = parent.find('.product-list-row');
        var row = list.find('.row');
        var row_scroll_width = parseInt(row[0].scrollWidth);
        var offset = list.scrollLeft();
        var true_offset = parseInt(offset) + list.width() + 15;
        var prev_elm = parent.find('.list-control-prev');

        if (true_offset < row_scroll_width) {
            if (true_offset + list.width() > row_scroll_width) {
                $(this).addClass('unavailable');
            }
            if (prev_elm.hasClass('unavailable')) {
                prev_elm.removeClass('unavailable');
            }
            offset = offset + list.width();
            list.animate({scrollLeft: offset}, 500);
            return true;
        }


    });
    $(".list-control-prev").click(function () {
        var parent = $(this).closest('.products-list-wrapper');
        var list = parent.find('.product-list-row');
        var offset = list.scrollLeft();
        var next_elm = parent.find('.list-control-next');
        if (offset > 0) {
            if (offset < list.width()) {
                $(this).addClass('unavailable');
            }
            if (next_elm.hasClass('unavailable')) {
                next_elm.removeClass('unavailable');
            }
            offset = offset - list.width();
            console.log(offset);
            list.animate({scrollLeft: offset}, 500);
            return true;
        }
    });
</script>
</body>
</html>