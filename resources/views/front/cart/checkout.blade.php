@extends('front.cart.layouts.master')
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
            @include('front.cart.layouts.shipping_address_form')
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
            <a href="{{route('cart.payment',['lang'=>$lang])}}" class="btn btn-primary btn-block cart-btn">
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