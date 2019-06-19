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
                <div class="col-md-4 checkout-step done">
                    <div class="checkout-step-title">
                        {{translate('SHIPPING')}}
                        <span class="num"><i class="fas fa-check"></i></span>
                    </div>
                </div>
                <div class="col-md-4 checkout-step current">
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
                <div class="payment-options">
                    <h2>{{translate('PAYMENT METHOD')}}</h2>
                    <div class="payment-options-wrapper">
                        <div class="payment-header">
                            {{translate('How would you like to pay')}}
                            <span class="total">{{number_format($cart->total(),2,'.',',')}} {{strtoupper(currency())}}</span>
                        </div>
                        <div class="payment-method">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="credit">
                                    {{translate('Credit or Debit Cards')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="right-cart-items-container">
                <h2>{{translate('SHOPPING CART')}}</h2>
                <a href="{{route('cart.checkout',['lang'=>$lang])}}">{{translate('Back to cart')}}</a>
                <div class="right-cart-wrapper">
                    <div class="cart-list-wrapper">
                        <div class="cart-list">
                            @foreach($cart->all() as $key=>$product)
                                <div class="cart-list-item row">
                                    <div class="col-md-2">
                                        <div class="cart-item-img">
                                            <img src="{{asset('images/products/thumbSm/'.$product->img)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <h3>{{translateModel($product->product,'name')}}</h3>
                                        <span class="cart-list-item-price">
                                    {{number_format($product->price,2,'.',',')}} {{currency()}}
                                </span>
                                        <div class="cart-list-item-qty">
                                            QTY: {{$product->quantity}}
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="cart-summary">
                        <table>
                            <tr>
                                <td>{{translate('Items')}}:</td>
                                <td>{{number_format($cart->total(),2,'.',',')}} {{strtoupper(currency())}}</td>
                            </tr>
                            <tr>
                                <td>+ {{translate('Shipping')}}:</td>
                                <td>{{translate('Free Shipping')}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="cart-total">
                        <div class="row">
                            <div class="col">
                                {{translate('Grand Total')}}
                            </div>
                            <div class="col">
                                {{number_format($cart->total(),2,'.',',')}} {{strtoupper(currency())}}
                            </div>
                        </div>
                        <div class="notes">{{translate('Order total includes any applicable VAT')}}</div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block">{{translate('PLACE ORDER')}}</button>
            </div>
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