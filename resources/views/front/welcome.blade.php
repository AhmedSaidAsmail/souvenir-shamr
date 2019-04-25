@extends('front.layouts.master')
@section('meta_tags')
    <title>Title</title>
@endsection
@section('banner')
    @include('front.layouts._banner')
@endsection
@section('content')
    <div class="welcome-container">
        <div class="container">
            @include('front.layouts._welcome_upper_section')
            <div class="row">
                <div class="product-list">
                    <h1>{{translate('Recommended For You')}}</h1>
                    <div class="products-list-wrapper">
                            <span class="list-control-prev unavailable">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        <span class="list-control-next">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        <div class="product-list-row">
                            <div class="row">
                                @foreach($recommendation as $product)
                                    @include('front.layouts._products_narrow_template')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="info-holder">
                    <img src="images/Free-Shipping-en.png" alt="">
                </div>
            </div>
            @foreach($homeCategories as $category)
                <?php
                $category_parameters = [
                    'lang' => $lang,
                    'category_name' => translateModel($category, 'name'),
                    'id' => $category->id
                ]
                ?>
                <div class="row">
                    <div class="category-holder">
                        <a href="{{route('home.category',$category_parameters)}}">
                            <img src="{{asset('images/categories/'.$category->welcome_image)}}"
                                 alt="{{translateModel($category,'name')}}">
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="product-list">
                    <h1>{{translate('Most popular')}}</h1>
                    <div class="products-list-wrapper">
                            <span class="list-control-prev unavailable">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        <span class="list-control-next">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        <div class="product-list-row">
                            <div class="row">
                                @foreach($popular as $product)
                                    @include('front.layouts._products_narrow_template')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product-list">
                    <h1>{{translate('Top picks in souvenir')}}</h1>
                    <div class="products-list-wrapper">
                            <span class="list-control-prev unavailable">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        <span class="list-control-next">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        <div class="product-list-row">
                            <div class="row">
                                @foreach($top as $product)
                                    @include('front.layouts._products_narrow_template')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection