@extends('front.layouts.master')
@section('meta_tags')
    <title>{{translate('Shopping Cart')}} | souvenirsharm.com</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection
@section('content')
    <div class="cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 cart-all-items">
                    <h3>{{translate('shopping cart')}} ({{$cart->count()}})</h3>
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
                <div class="col-md-4">
                    <div class="cart-total-wrapper">
                        <span class="total-ref">{{translate('Total')}}:</span>
                        <span class="total-amount">{{number_format($cart->total(),2,'.',',')}}</span>
                        <span class="total-amount-currency">{{currency()}}</span>
                    </div>
                    <a href="{{route('cart.checkout',['lang'=>$lang])}}" class="btn btn-primary btn-block cart-btn">
                        {{translate('PROCEED TO CHECKOUT')}}
                    </a>
                    <a href="{{route('home')}}" class="btn btn-success btn-block cart-btn">
                        {{translate('CONTINUE SHOPPING')}}
                    </a>
                    @if(!auth()->guard('customer')->check())
                        <div class="user-register">
                            <a href="{{route('customer.register')}}">{{translate('Crate an account')}}</a> {{translate('or')}}
                            <a href="{{route('customer.login')}}">{{translate('Log in')}}</a> {{translate('for faster checkout')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection