@extends('front.layouts.master')
@section('meta_tags')
    <title>{{translateModel($section->detail,'meta_title')}}</title>
    <meta name="keywords" content="{{translateModel($section->detail,'meta_keywords')}}">
    <meta name="description" content="{{translateModel($section->detail,'meta_description')}}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/section.css')}}">
@endsection
@section('banner')
    <div class="section-banner">
        <img src="{{asset('images/sections/'.$section->banner_img)}}" alt="{{$name}}">
    </div>
@endsection
@section('content')
    <div class="insider-container">
        <div class="container">
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
                                @foreach($section->products()->home('top','products.')->get()->all() as $product)
                                    @include('front.layouts._products_narrow_template')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-by">
                <h2>{{translate('Shop By Category')}}</h2>
                <div class="row section-category-wrapper">
                    @foreach($section->categories->slice(0,2) as $category)
                        <?php
                        $category_parameters = [
                            'lang' => $lang,
                            'name' => translateModel($category, 'name'),
                            'id' => $category->id
                        ]
                        ?>
                        <div class="col-md-6">
                            <div class="section-category-bg">
                                <a href="{{route('home.category',$category_parameters)}}">
                                    <img src="{{asset('images/categories/'.$category->image)}}"
                                         alt="{{translateModel($category,'name')}}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach($section->categories->slice(2)->chunk(4) as $chunk)
                    <div class="row section-category-wrapper">
                        @foreach($chunk as $category)
                            <?php
                            $category_parameters = [
                                'lang' => $lang,
                                'category_name' => translateModel($category, 'name'),
                                'id' => $category->id
                            ]
                            ?>
                            <div class="col">
                                <div class="section-category-sm">
                                    <a href="{{route('home.category',$category_parameters)}}">
                                        <img src="{{asset('images/categories/'.$category->image)}}"
                                             alt="{{translateModel($category,'name')}}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection