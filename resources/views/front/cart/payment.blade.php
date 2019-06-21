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

            <div class="payment-options">
                <h2>{{translate('PAYMENT METHOD')}}</h2>
                <form id="payment_form" method="post" action="{{route('cart.payment.proceed',['lang'=>$lang])}}">
                    {{csrf_field()}}
                    <input id="token" name="token" type="hidden" value="">
                    <div class="payment-options-wrapper">
                        <div class="payment-header">
                            {{translate('How would you like to pay')}}
                            <span class="total">{{number_format($cart->total(),2,'.',',')}} {{strtoupper(currency())}}</span>
                        </div>
                        {{-- Payment Gateway--}}
                        @if($credit_gateway)
                            <div class="payment-method" id="credit_section">
                                <input type="hidden" name="environment"
                                       value="{!! $credit_gateway->sandbox?"sandbox":"production" !!}">
                                <input type="hidden" name="partner_id" value="{{$credit_gateway->partner_id}}">
                                <input type="hidden" name="public_key" value="{{$credit_gateway->public_key}}">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_method" value="payment_gateway"
                                                {!! $default_payment=='payment_gateway'?'checked':null !!}>
                                        {{translate('Credit or Debit Cards')}}
                                    </label>
                                </div>
                                <div class="credit-symbols">
                                    <img class="symbol" src="{{asset('images/master-card.png')}}">
                                    <img class="symbol" src="{{asset('images/visa.png')}}">
                                </div>
                                <div class="credit-form">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{translate('Card number')}} *</label>
                                                <input class="form-control" value="4000000000000002"
                                                       name="credit[cc_no]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{translate('Card holder\'s name')}} *</label>
                                                <input class="form-control" value="Ahmed Said asmail"
                                                       name="credit[name]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>{{translate('Expiry date')}} *</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="credit[cc_expire_month]"
                                                            required>
                                                        <option value="02">MM</option>
                                                        @for($i=1;$i<=12;$i++)
                                                            <option value="{{sprintf('%02d',$i)}}">{{sprintf('%02d',$i)}}</option>
                                                        @endfor
                                                    </select>
                                                    <select class="form-control" name="credit[cc_expire_year]" required>
                                                        <option value="2020">YYYY</option>
                                                        @for($i=0;$i<20;$i++)
                                                            <option value="{{\Carbon\Carbon::now()->addYear($i)->format('Y')}}">
                                                                {{\Carbon\Carbon::now()->addYear($i)->format('Y')}}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{translate('Card verification code')}} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <img src="{{asset('images/cvv.png')}}">
                                                    </div>
                                                    <input class="form-control" value="012" name="credit[cvv]" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Payment Gateway--}}
                        {{-- Paypal Payment Gaetway--}}
                        @if($paypal_gateway)
                            <div class="payment-method">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_method" value="paypal"
                                                {!! $default_payment=='paypal_gateway'?'checked':null !!}>
                                        {{translate('Pay with Paypal')}}
                                    </label>
                                </div>
                                <div class="credit-symbols">
                                    <img class="symbol paypal" src="{{asset('images/paypal.png')}}">
                                </div>
                            </div>
                        @endif
                        {{-- Paypal Payment Gaetway--}}
                        {{-- COD --}}
                        <div class="payment-method">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="cash_on_delivery"
                                            {!! $default_payment=='cash_on_delivery'?'checked':null !!}>
                                    {{translate('Cash on delivery')}} (COD)
                                </label>
                            </div>
                        </div>
                        {{-- COD --}}
                    </div>
                </form>
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
                <button class="btn btn-primary btn-block" id="button_submit" form="payment_form">
                    {{translate('PLACE ORDER')}} <img src="{{asset('images/loading-gif-png-4.gif')}}">
                </button>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script>
        var paymentForm, paymentMethod, creditSection;
        paymentForm = document.getElementById("payment_form");
        paymentMethod = paymentForm.querySelectorAll('input[name="payment_method"]');
        creditSection = document.getElementById('credit_section');
        const creditCardElement = (elementName) => paymentForm.querySelector("[name='" + elementName + "']");
        let choosenPayment = function () {
            let method;
            paymentMethod.forEach(function (item) {
                if (item.checked) {
                    method = item.value;
                }
            });
            return method;
        };
        // 2checkout api
        let successCallback = function (data) {
            paymentForm.token.value = data.response.token.token;
            paymentForm.submit();
        };
        let errorCallback = function (data) {
            if (data.errorCode === 200) {
                tokenRequest();
            } else {
                alert(data.errorMsg);
            }
        };
        let tokenRequest = function () {
            let args = {
                sellerId: creditCardElement('partner_id').value,
                publishableKey: creditCardElement('public_key').value,
                ccNo: creditCardElement('credit[cc_no]').value,
                cvv: creditCardElement('credit[cvv]').value,
                expMonth: creditCardElement('credit[cc_expire_month]').value,
                expYear: creditCardElement('credit[cc_expire_year]').value
            };
            // Make  token request
            TCO.requestToken(successCallback, errorCallback, args);
        };
        // end api
        paymentMethod.forEach(function (elm) {
            elm.addEventListener('click', function () {
                makeCreditSectionRequired(this, creditSection);
            });
        });
        (function () {
            TCO.loadPubKey(creditCardElement('environment').value);
        })();
        paymentForm.addEventListener('submit', function (event) {
            event.preventDefault();
            document.getElementById('button_submit').classList.add('active');
            if (choosenPayment() === "payment_gateway") {
                tokenRequest();
                return false;
            }
            paymentForm.submit();
        });

        function makeCreditSectionRequired(radioElm, creditSection) {
            if (creditSection !== null) {
                let creditSectionInputs = creditSection.querySelectorAll(".form-control");
                if (radioElm.value === "payment_gateway") {
                    creditSectionInputs.forEach(function (elm) {
                        elm.required = true;
                    });
                } else {
                    creditSectionInputs.forEach(function (elm) {
                        elm.required = false;
                    });
                }
            }
        }
    </script>
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