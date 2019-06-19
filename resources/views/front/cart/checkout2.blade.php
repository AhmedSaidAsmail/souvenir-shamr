@extends('font.cart.layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/checkout.css')}}">
@endsection
@section('checkout_nav')
    <div class="row checkout-top-nav">
        <div class="col-md-4 checkout-logo">
            <a href="{{route('home')}}">
                <img src="{{asset('images/logo.jpg')}}">
            </a>
            <i class="fas fa-lock"></i> {{translate('Secure checkout')}}
        </div>
        <div class="col-md-5 checkout-timeline">
            <div class="row">
                <div class="col-md-4 checkout-step current">
                    <div class="checkout-step-title">
                        {{translate('SHIPPING')}}
                        <span class="num">1</span>
                    </div>
                </div>
                <div class="col-md-4 checkout-step">
                    <div class="checkout-step-title">
                        {{translate('PAYMENT')}}
                        <span class="num">2</span>
                    </div>
                </div>
                <div class="col-md-4 checkout-step">
                    <div class="checkout-step-title">
                        {{translate('DONE')}}
                        <span class="num">3</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="user-auth">
                {{auth()->guard('customer')->user()->name}}
            </div>
        </div>
    </div>
@endsection
@section('container')
    <div class="row">
        <div class="col-md-8 checkout-details-wrapper">
            @if($add=auth()->guard('customer')->user()->details)
                <div class="shipping-address-wrapper">
                    <h2>{{translate('SHIPPING ADDRESS')}}</h2>
                    <a href="#" class="edit-address">{{translate('Edit Delivery Location')}}</a>
                    <div class="shipping-address">
                        <span>{{translate('Delivery address')}}</span>
                        <p>{{auth()->guard('customer')->user()->name}}, {{$add->location()->address}}</p>
                        <p>{{$add->phone}}</p>
                        @if($add->hotel()->exists())
                            {{$add->hotel->hotel}}, Room No: {{$add->room_no}}
                        @endif
                        <div class="update-location-form">
                            <form method="post"
                                  action="{{route('cart.checkout.shippingAddress.update',['lang'=>$lang,'address_id'=>$add->id])}}"
                                  id="location_form">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="customer_id"
                                       value="{{auth()->guard('customer')->user()->id}}">
                                <input type="hidden" name="city" value="{{$add->city}}">
                                <input type="hidden" name="country" value="{{$add->country}}">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>{{translate('phone')}}</label>
                                            <input class="form-control" name="phone" value="{{$add->phone}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Hotel</label>
                                            <select name="hotel_id" class="form-control">
                                                <option value="">{{translate('Select a hotel')}}</option>
                                                @foreach($hotels as $hotel)
                                                    <option value="{{$hotel->id}}"
                                                            {!! $add->hotel_id==$hotel->id?"selected":null !!}>
                                                        {{$hotel->hotel}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>{{translate('Room No')}}</label>
                                            <input class="form-control" name="room_no" value="{{$add->room_no}}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address" value="{{$add->address}}"
                                                   placeholder="Your location address">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a class="add-location" href="#">
                    <i class="fas fa-plus-circle"></i> {{translate('Add shipping address')}}
                </a>
                <div class="location-form">
                    <form method="post" action="{{route('cart.checkout.shippingAddress.add',['lang'=>$lang])}}"
                          id="location_form">
                        {{csrf_field()}}
                        <input type="hidden" name="customer_id"
                               value="{{auth()->guard('customer')->user()->id}}">
                        <input type="hidden" name="city" value="sharm el sheikh">
                        <input type="hidden" name="country" value="Egypt">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>{{translate('phone')}}</label>
                                    <input class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Hotel</label>
                                    <select name="hotel_id" class="form-control">
                                        <option value="">{{translate('Select a hotel')}}</option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{$hotel->id}}">{{$hotel->hotel}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{translate('Room No')}}</label>
                                    <input class="form-control" name="room_no" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="address"
                                           placeholder="Your location address">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
                    </form>
                </div>
            @endif
            <div class="checkout-cart-items">
                @foreach($cart->all() as $key=>$product)
                    <div class="cart-item-wrapper row">
                        <div class="col-md-2">
                            <div class="cart-item-img">
                                <img src="{{asset('images/products/thumbSm/'.$product->img)}}">
                            </div>
                        </div>
                        <div class="col-md-10 cart-item-details-wrapper">
                            <h3>{{translateModel($product->product,'name')}}</h3>
                            <span class="cart-item-price">
                                    {{number_format($product->price,2,'.',',')}} {{currency()}}
                                @if($product->quantity > 1)
                                    <label>
                                            ({{number_format($product->price()['price'],2,'.',',')}} {{currency()}}
                                        <i>{{translate('each')}}</i>
                                            )
                                        </label>
                                @endif
                                </span>
                            <div class="cart-item-qty">
                                <span>QTY</span>
                                <span class="qty-num">{{$product->quantity}}</span>
                            </div>
                            <div class="cart-item-details">
                                <div class="row">
                                    <div class="col-md-2 col-xs-3">{{translate('Sold by')}}:</div>
                                    <div class="col-md-10 col-xs-9">{{$product->vendor->name}}</div>
                                </div>
                                @foreach($product->details as $detail_name=>$detail)
                                    <div class="row">
                                        <div class="col-md-2 col-xs-3">{{$detail_name}}:</div>
                                        <div class="col-md-10 col-xs-9">{{$detail}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="cart-item-remove">
                            <a href="{{route('cart.destroy',['lang'=>$lang,'cart_id'=>$key])}}">
                                <i class="fas fa-trash"></i> {{translate('remove')}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="cart-total-wrapper">
                <span class="total-ref">{{translate('Total')}}:</span>
                <span class="total-amount">{{number_format($cart->total(),2,'.',',')}}</span>
                <span class="total-amount-currency">{{currency()}}</span>
            </div>
            <a href="{{route('cart.checkout',['lang'=>$lang])}}" class="btn btn-primary btn-block cart-btn">
                {{translate('CONTINUE')}}
            </a>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        function ShippingAddersForm(navigatorButtonClass, formContainer) {
            this.navigatorClass = navigatorButtonClass;
            this.formContainerClass = formContainer;
            this.formWrapper = function () {
                return document.querySelector('.' + this.formContainerClass);
            };
            this.hotelSelector = function () {
                return this.formWrapper() !== null ?
                    this.formWrapper().querySelector('select[name="hotel_id"]') : undefined;
            };
            this.roomInput = function () {
                return this.formWrapper() !== null ?
                    this.formWrapper().querySelector('input[name="room_no"]') : undefined;
            };
            this.addressInput = function () {
                return this.formWrapper() !== null ?
                    this.formWrapper().querySelector('input[name="address"]') : undefined;
            };
            this.toggleForm = function () {
                let formContainer = this.formWrapper();
                let button = document.getElementsByClassName(this.navigatorClass)[0];
                if (button !== undefined) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        if (!formContainer.classList.contains('active')) {
                            formContainer.classList.add('active');
                            return true;
                        }
                        formContainer.classList.remove('active');
                    });
                }

            };
            this.selectHotel = function () {
                let roomInput, addressInput;
                roomInput = this.roomInput();
                addressInput = this.addressInput();
                if (this.hotelSelector() !== undefined) {
                    this.hotelSelector().addEventListener('change', function () {
                        if (this.value.length !== 0) {
                            roomInput.disabled = false;
                            addressInput.disabled = true;
                            return true;
                        }
                        roomInput.disabled = true;
                        addressInput.disabled = false;
                    });
                }
            }

        }

        let form = new ShippingAddersForm('add-location', 'location-form');
        form.toggleForm();
        form.selectHotel();
        let updatedForm = new ShippingAddersForm('edit-address', 'update-location-form');
        updatedForm.toggleForm();
        updatedForm.selectHotel();
    </script>
@endsection


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | Souvenirsharm.com</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/checkout.css')}}">
    @yield('css')
</head>
<body>
<div class="body-wrapper">
    <div class="content-wrapper">
        <header>
            @include('front.layouts._top_nav')
            <div class="row checkout-top-nav">
                <div class="col-md-4 checkout-logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/logo.jpg')}}">
                    </a>
                    <i class="fas fa-lock"></i> {{translate('Secure checkout')}}
                </div>
                <div class="col-md-5 checkout-timeline">
                    <div class="row">
                        <div class="col-md-4 checkout-step current">
                            <div class="checkout-step-title">
                                {{translate('SHIPPING')}}
                                <span class="num">1</span>
                            </div>
                        </div>
                        <div class="col-md-4 checkout-step">
                            <div class="checkout-step-title">
                                {{translate('PAYMENT')}}
                                <span class="num">2</span>
                            </div>
                        </div>
                        <div class="col-md-4 checkout-step">
                            <div class="checkout-step-title">
                                {{translate('DONE')}}
                                <span class="num">3</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="user-auth">
                        {{auth()->guard('customer')->user()->name}}
                    </div>
                </div>
            </div>
        </header>
        <div class="container checkout-container">
            <div class="row">
                <div class="col-md-8 checkout-details-wrapper">
                    @if($add=auth()->guard('customer')->user()->details)
                        <div class="shipping-address-wrapper">
                            <h2>{{translate('SHIPPING ADDRESS')}}</h2>
                            <a href="#" class="edit-address">{{translate('Edit Delivery Location')}}</a>
                            <div class="shipping-address">
                                <span>{{translate('Delivery address')}}</span>
                                <p>{{auth()->guard('customer')->user()->name}}, {{$add->location()->address}}</p>
                                <p>{{$add->phone}}</p>
                                @if($add->hotel()->exists())
                                    {{$add->hotel->hotel}}, Room No: {{$add->room_no}}
                                @endif
                                <div class="update-location-form">
                                    <form method="post"
                                          action="{{route('cart.checkout.shippingAddress.update',['lang'=>$lang,'address_id'=>$add->id])}}"
                                          id="location_form">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="customer_id"
                                               value="{{auth()->guard('customer')->user()->id}}">
                                        <input type="hidden" name="city" value="{{$add->city}}">
                                        <input type="hidden" name="country" value="{{$add->country}}">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>{{translate('phone')}}</label>
                                                    <input class="form-control" name="phone" value="{{$add->phone}}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Hotel</label>
                                                    <select name="hotel_id" class="form-control">
                                                        <option value="">{{translate('Select a hotel')}}</option>
                                                        @foreach($hotels as $hotel)
                                                            <option value="{{$hotel->id}}"
                                                                    {!! $add->hotel_id==$hotel->id?"selected":null !!}>
                                                                {{$hotel->hotel}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>{{translate('Room No')}}</label>
                                                    <input class="form-control" name="room_no" value="{{$add->room_no}}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input class="form-control" name="address" value="{{$add->address}}"
                                                           placeholder="Your location address">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a class="add-location" href="#">
                            <i class="fas fa-plus-circle"></i> {{translate('Add shipping address')}}
                        </a>
                        <div class="location-form">
                            <form method="post" action="{{route('cart.checkout.shippingAddress.add',['lang'=>$lang])}}"
                                  id="location_form">
                                {{csrf_field()}}
                                <input type="hidden" name="customer_id"
                                       value="{{auth()->guard('customer')->user()->id}}">
                                <input type="hidden" name="city" value="sharm el sheikh">
                                <input type="hidden" name="country" value="Egypt">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>{{translate('phone')}}</label>
                                            <input class="form-control" name="phone">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Hotel</label>
                                            <select name="hotel_id" class="form-control">
                                                <option value="">{{translate('Select a hotel')}}</option>
                                                @foreach($hotels as $hotel)
                                                    <option value="{{$hotel->id}}">{{$hotel->hotel}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>{{translate('Room No')}}</label>
                                            <input class="form-control" name="room_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address"
                                                   placeholder="Your location address">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
                            </form>
                        </div>
                    @endif
                    <div class="checkout-cart-items">
                        @foreach($cart->all() as $key=>$product)
                            <div class="cart-item-wrapper row">
                                <div class="col-md-2">
                                    <div class="cart-item-img">
                                        <img src="{{asset('images/products/thumbSm/'.$product->img)}}">
                                    </div>
                                </div>
                                <div class="col-md-10 cart-item-details-wrapper">
                                    <h3>{{translateModel($product->product,'name')}}</h3>
                                    <span class="cart-item-price">
                                    {{number_format($product->price,2,'.',',')}} {{currency()}}
                                        @if($product->quantity > 1)
                                            <label>
                                            ({{number_format($product->price()['price'],2,'.',',')}} {{currency()}}
                                                <i>{{translate('each')}}</i>
                                            )
                                        </label>
                                        @endif
                                </span>
                                    <div class="cart-item-qty">
                                        <span>QTY</span>
                                        <span class="qty-num">{{$product->quantity}}</span>
                                    </div>
                                    <div class="cart-item-details">
                                        <div class="row">
                                            <div class="col-md-2 col-xs-3">{{translate('Sold by')}}:</div>
                                            <div class="col-md-10 col-xs-9">{{$product->vendor->name}}</div>
                                        </div>
                                        @foreach($product->details as $detail_name=>$detail)
                                            <div class="row">
                                                <div class="col-md-2 col-xs-3">{{$detail_name}}:</div>
                                                <div class="col-md-10 col-xs-9">{{$detail}}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="cart-item-remove">
                                    <a href="{{route('cart.destroy',['lang'=>$lang,'cart_id'=>$key])}}">
                                        <i class="fas fa-trash"></i> {{translate('remove')}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-total-wrapper">
                        <span class="total-ref">{{translate('Total')}}:</span>
                        <span class="total-amount">{{number_format($cart->total(),2,'.',',')}}</span>
                        <span class="total-amount-currency">{{currency()}}</span>
                    </div>
                    <a href="{{route('cart.checkout',['lang'=>$lang])}}" class="btn btn-primary btn-block cart-btn">
                        {{translate('CONTINUE')}}
                    </a>
                </div>
            </div>
        </div>
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
                            <a href="{{route('home.change.lang',['lang'=>'en'])}}">
                                <img src="{{asset('images/en-flag.jpg')}}">
                            </a>
                            <a href="{{route('home.change.lang',['lang'=>'ar'])}}">
                                <img src="{{asset('images/eg-flag.jpg')}}">
                            </a>
                            <a href="{{route('home.change.lang',['lang'=>'ru'])}}">
                                <img src="{{asset('images/ru-flag.jpg')}}">
                            </a>
                            <a href="{{route('home.change.lang',['lang'=>'it'])}}">
                                <img src="{{asset('images/it-flag.jpg')}}">
                            </a>
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
<script>
    function ShippingAddersForm(navigatorButtonClass, formContainer) {
        this.navigatorClass = navigatorButtonClass;
        this.formContainerClass = formContainer;
        this.formWrapper = function () {
            return document.querySelector('.' + this.formContainerClass);
        };
        this.hotelSelector = function () {
            return this.formWrapper() !== null ?
                this.formWrapper().querySelector('select[name="hotel_id"]') : undefined;
        };
        this.roomInput = function () {
            return this.formWrapper() !== null ?
                this.formWrapper().querySelector('input[name="room_no"]') : undefined;
        };
        this.addressInput = function () {
            return this.formWrapper() !== null ?
                this.formWrapper().querySelector('input[name="address"]') : undefined;
        };
        this.toggleForm = function () {
            let formContainer = this.formWrapper();
            let button = document.getElementsByClassName(this.navigatorClass)[0];
            if (button !== undefined) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (!formContainer.classList.contains('active')) {
                        formContainer.classList.add('active');
                        return true;
                    }
                    formContainer.classList.remove('active');
                });
            }

        };
        this.selectHotel = function () {
            let roomInput, addressInput;
            roomInput = this.roomInput();
            addressInput = this.addressInput();
            if (this.hotelSelector() !== undefined) {
                this.hotelSelector().addEventListener('change', function () {
                    if (this.value.length !== 0) {
                        roomInput.disabled = false;
                        addressInput.disabled = true;
                        return true;
                    }
                    roomInput.disabled = true;
                    addressInput.disabled = false;
                });
            }
        }

    }

    let form = new ShippingAddersForm('add-location', 'location-form');
    form.toggleForm();
    form.selectHotel();
    let updatedForm = new ShippingAddersForm('edit-address', 'update-location-form');
    updatedForm.toggleForm();
    updatedForm.selectHotel();
</script>
</body>
</html>