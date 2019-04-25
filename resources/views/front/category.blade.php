@extends('front.layouts.master')
@section('meta_tags')
    <title>{{translateModel($category->detail,'meta_title')}}</title>
    <meta name="keywords" content="{{translateModel($category->detail,'meta_keywords')}}">
    <meta name="description" content="{{translateModel($category->detail,'meta_description')}}">
@endsection
@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="{{asset('css/category.css')}}">
@endsection
@section('banner')
    <div class="category-banner">
        <img src="{{asset('images/categories/'.$category->banner_image)}}" alt="{{$name}}">
    </div>
@endsection
@section('content')
    <div class="category-container">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <?php
                    $category_parameters = [
                        'lang' => $lang,
                        'category_name' => translateModel($category(), 'name'),
                        'id' => $category->id
                    ]
                    ?>
                    <form method="get" action="{{route('home.category',$category_parameters)}}">
                        @if($childs=$category->childs())
                            <div class="category-filter-section">
                                <h3>{{translate('Categories')}}</h3>
                                <div class="filters-options">
                                    @foreach($childs as $child)
                                        @if($child->count()>0)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="categories[]" value="{{$child->id}}">
                                                    {{translateModel($child(),'name')}}
                                                    <span>({{$child->count()}})</span>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="category-filter-section">
                            <h3>Brands</h3>
                            <div class="filters-options">
                                @foreach($category->brands() as $brand)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="brands[]" value="1">
                                            {{translateModel($brand(),'name')}}<span>({{$brand->count()}})</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="category-filter-section">
                            <h3>Color</h3>
                            <div class="filters-options">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="6">
                                        test2<span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="8">
                                        Test final update <span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="9">
                                        Laptop <span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="17">
                                        test Category <span>(0)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="category-filter-section">
                            <h3>Categories</h3>
                            <div class="filters-options">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="6">
                                        test2<span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="8">
                                        Test final update <span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="9">
                                        Laptop <span>(0)</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="17">
                                        test Category <span>(0)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="category-filter-section">
                            <h3>Price</h3>
                            <div class="filters-options">
                                <div class="row price-range-inputs">
                                    <div class="col">
                                        <label>From (USD)</label>
                                        <input class="form-control" id="price_from" name="" value="{{$category->price()->min()}}">
                                    </div>
                                    <div class="col">
                                        <label>To (USD)</label>
                                        <input class="form-control" id="price_to" name="" value="{{$category->price()->max()}}">
                                    </div>
                                </div>
                                <div class="price-range">
                                    <input id="ex2" type="text" class="span2" value="" data-slider-min="{{$category->price()->min()}}"
                                           data-slider-max="{{$category->price()->max()}}" data-slider-step="5" data-slider-value="[{{$category->price()->min()}},{{$category->price()->max()}}]">
                                </div>
                                <button class="btn btn-warning btn-block">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-10">
                    <ul class="dir nav">
                        <li class="nav-item">
                            <a href="">
                                Section 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="">
                                <span>{{translateModel($category(),'name')}}</span>
                                ({{$category->products()->count()}} {{translate('items')}})
                            </a>
                        </li>
                    </ul>
                    <div class="category-list">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="category-product">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>HP 250 G6 Notebook- Intel Core i3-6006U , 15.6 Inch , 1TB, 4GB RAM, AMD
                                            Rdeon R5 , DOS , Black</h2>
                                        <div class="product-footer">
                                            <div class="row">
                                                <div class="col-6 product-price">
                                                    <div class="discount-wrapper">
                                                        usd 109.00
                                                        <span>7% off</span>
                                                    </div>
                                                    usd 105.00
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="product-rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>

                                                    </div>
                                                </div>
                                            </div>
                                            <a href="" class="btn btn-warning btn-block">
                                                add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js"></script>
    <script>
        $(".category-filter-section >h3").click(function () {
            var parent = $(this).closest('.category-filter-section');
            if (!parent.hasClass('expended')) {
                parent.addClass('expended');
                return true;
            }
            parent.removeClass('expended');
        });
        // price range slider
        var input_price_from = $("input#price_from");
        var input_price_to = $("input#price_to");
        var slider = $("#ex2").slider({});
        slider.on('slideStop', function (a) {
            input_price_from.val(a['value'][0]);
            input_price_to.val(a['value'][1]);
        });
    </script>
@endsection