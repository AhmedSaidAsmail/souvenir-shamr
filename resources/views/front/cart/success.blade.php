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
                <div class="col-md-4 checkout-step done">
                    <div class="checkout-step-title">
                        {{translate('PAYMENT')}}
                        <span class="num"><i class="fas fa-check"></i></span>
                    </div>
                </div>
                <div class="col-md-4 checkout-step current">
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
    <div class="success-checkout">
        <h1>{{translate('Thank You for Purchasing SouvenirSharm Online! ')}}</h1>
        <div class="checkout-success-details">
            <div class="checkout-success-details-header">
                <h2>{{translate('A confirmation has been sent to your email address')}}</h2>
            </div>
            <div class="checkout-success-details-body">
                <div class="row">
                    <div class="col-md-6 img-wrapper">
                        <img src="{{asset('images/success-payment.png')}}">
                    </div>
                    <div class="col-md-6 details-wrapper">
                        <table>
                            <tr>
                                <td>Email(Login):</td>
                                <td>{{auth()->guard('customer')->user()->email}}</td>
                            </tr>
                            <tr>
                                <td>Account Name:</td>
                                <td>{{auth()->guard('customer')->user()->name}}</td>
                            </tr>
                            <tr>
                                <td>Order Number:</td>
                                <td>{{$reservation->unique_id}}</td>
                            </tr>
                            @if($reservation->payment_approval)
                                <tr>
                                    <td>Transaction ID:</td>
                                    <td>{{$reservation->transaction_id}}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection