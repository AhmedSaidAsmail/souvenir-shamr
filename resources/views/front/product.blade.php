@extends('front.layouts.master')
@section('meta_tags')
    <title>{{translateModel($product->meta,'meta_title')}}</title>
    <meta name="keywords" content="{{translateModel($product->meta,'meta_keywords')}}">
    <meta name="description" content="{{translateModel($product->meta,'meta_description')}}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
@endsection
@section('content')
    <div class="product-container">
        <div class="container">
            <ul class="product-dir nav">
                <li class="nav-item">
                    {{translate('home')}}
                </li>
                @foreach($product->category->allParents() as $child)
                    <?php
                    $category_parameters = [
                        'lang' => $lang,
                        'category_name' => translateModel($child, 'name'),
                        'id' => $child->id
                    ]
                    ?>
                    <li class="nav-item">
                        <a href="{{route('home.category',$category_parameters)}}">
                            {{translateModel($child,'name')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            {{translateModel($product,'name')}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="row">
                <div class="col-md-4">
                    <div class="product-image">
                        @if($product->gallery()->exists())
                            <div class="images-thumbs">
                                <div class="products-thumb active">
                                    <div class="thumb" data-img="{{asset('images/products/'.$product->img)}}">
                                        <a class="thumb-img" href="{{asset('images/products/thumbMd/'.$product->img)}}">
                                            <img src="{{asset('images/products/thumbSm/'.$product->img)}}" alt="">
                                        </a>
                                    </div>
                                </div>
                                @foreach($product->gallery as $image)
                                    <div class="products-thumb">
                                        <div class="thumb" data-img="{{asset('images/products/'.$image->image)}}">
                                            <a class="thumb-img"
                                               href="{{asset('images/products/thumbMd/'.$image->image)}}">
                                                <img src="{{asset('images/products/thumbSm/'.$image->image)}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div id="zoomed_image" class="img-zoom-container"
                             data-img="{{asset('images/products/'.$product->img)}}">
                            <img id="main_image" src="{{asset('images/products/thumbMd/'.$product->img)}}">
                        </div>
                        <div id="image_result" class="img-zoom-result"></div>
                    </div>
                </div>
                <div class="col-md-4 product-details">
                    <a href="" class="brand">{{translateModel($product->brand,'name')}}</a>
                    <h2>{{translateModel($product,'name')}}</h2>
                    <span class="model">{{translate('Model Number')}}:{{$product->model}}</span>
                    <div class="rating">
                        <div class="stars-outer">
                            <div class="stars-inner"
                                 data-rating="{{overAllRatingPercentage($product)}}"></div>
                        </div>
                        <span class="rating-num">{{overAllRating($product)}}</span>
                        <span class="rating-reviews">({{$product->reviews()->count()}} {{translate('reviews')}})</span>
                    </div>
                    <div class="price-wrapper">
                        <span class="price">{{currency()}} {{number_format($product->price()['price'],2,'.',',')}}</span>
                        @if($product->price()['has_discount'])
                            <div class="discount-wrapper">
                                {{currency()}} {{number_format($product->price()['before'],2,'.',',')}}
                                <span>{{$product->price()['discount']}}% off</span>
                            </div>
                        @endif
                    </div>
                    {{--product filters --}}
                    @foreach($product->filters as $filter)
                        <div class="filter">
                            <h3>{{translateModel($filter,'name')}}:</h3>
                            <input type="hidden" name="[details]{{$filter->en_name}}"
                                   value="{{$filter->productFilterItems($product->id)->first()->item->en_name}}"
                                   class="filter-input">
                            <?php
                            $active = " active";
                            ?>
                            @foreach($filter->productFilterItems($product->id)->get() as $item)
                                <a href="#" data-content="{{$item->item->en_name}}"
                                   class="filter-item{{$active}}">{{translateModel($item->item,'name')}}</a>
                                <?php
                                $active = null;
                                ?>
                            @endforeach
                        </div>
                    @endforeach
                    {{--product filters --}}
                </div>
                <div class="col-md-4 product-checkout-wrapper">
                    <div class="product-checkout">
                        <div class="cart-symbol">
                            <span><i class="fas fa-truck"></i></span>
                            <h3>{{translate('trusted shipping')}}</h3>
                            {{translate('free shipping when you spend 100 usd and above')}}
                        </div>
                        <div class="cart-symbol">
                            <span><i class="fab fa-rev"></i></span>
                            <h3>{{translate('easy returns')}}</h3>
                            {{translate('free returns on eligible items so you can shop with ease')}}
                        </div>
                        <div class="cart-symbol">
                            <span><i class="fas fa-shield-alt"></i></span>
                            <h3>{{translate('secure shopping')}}</h3>
                            {{translate('your data is always protected')}}
                        </div>
                        <div class="form-row product-checkout-row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" type="number" value="1" min="1" name="quantity">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button class="btn btn-block product-checkout-button">{{translate('add to cart')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-description">
                <h2>{{translate('product information')}}</h2>
                <div class="product-information-wrapper">{!!translateModel($product->description,'description')!!}</div>
            </div>
            <div class="product-reviews">
                <h2>{{translate('customer reviews')}}</h2>
                <div class="product-rating">
                    <div class="row">
                        <div class="col">
                            <div class="ratings-overview">
                                <span class="rating-circle">{{overAllRating($product)}}</span>
                                <div class="stars-outer">
                                    <div class="stars-inner" data-rating="{{overAllRatingPercentage($product)}}">
                                    </div>
                                </div>
                                <span class="rating-of">{{overAllRating($product)}} {{translate('out of')}} 5</span>
                                <span class="total-ratings">{{$product->ratings()->count()}} {{ translate('ratings') }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="rating-stars-count">
                                @for($i=5;$i>=1;$i--)
                                    <?php
                                    $percentage = $product->ratings()->where('ratings.rate', $i)->count() /
                                        $product->ratings()->count() * 100;
                                    ?>
                                    <div class="row">
                                        <div class="col-md-3">{{$i}} stars</div>
                                        <div class="col-md-6">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                     style="width: {{$percentage}}%"
                                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            ({{$product->ratings()->where('ratings.rate',$i)->count()}})
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col">
                            <span class="rate-this">{{translate('rate this product')}}</span>
                            <form action="test.php" method="post">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="select-star-rating">
                                    <div class="select-rating" data-alt="1"></div>
                                    <div class="select-rating" data-alt="2"></div>
                                    <div class="select-rating" data-alt="3"></div>
                                    <div class="select-rating" data-alt="4"></div>
                                    <div class="select-rating" data-alt="5"></div>
                                </div>
                                <input type="hidden" name="rate" id="rating">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @parent
    <script>
        $("a.thumb-img").click(function (event) {
            event.preventDefault();
            var wrapper, container, zoomedImg, thumbImg, thumbDestiny, zoomedDestiny;
            wrapper = $(this).closest('.thumb');
            container = wrapper.closest('.products-thumb');
            zoomedImg = wrapper.attr('data-img');
            thumbImg = $(this).attr('href');
            thumbDestiny = $("img#main_image");
            zoomedDestiny = $("div#zoomed_image");
            if (!container.hasClass('active')) {
                $("div.products-thumb").removeClass('active');
                container.addClass('active');
                thumbDestiny.attr('src', thumbImg);
                zoomedDestiny.attr('data-img', zoomedImg);
                return true;
            }
        });
        $("img#main_image").mouseover(function () {
            imageZoom("main_image", "image_result", "zoomed_image");
        });
        $("div.img-zoom-container").mouseleave(function () {
            $("div.img-zoom-lens").remove();
            $("div.img-zoom-result").removeClass('available');
        });

        function imageZoom(imgID, resultID, zoomedImgID) {
            var img, zoomedImg, lens, result, cx, cy;
            img = document.getElementById(imgID);
            result = document.getElementById(resultID);
            zoomedImg = document.getElementById(zoomedImgID);
            /* display result div */
            result.classList.add('available');
            /* Create lens: */
            lens = document.createElement("DIV");
            lens.setAttribute("class", "img-zoom-lens");
            /* Insert lens: */
            img.parentElement.insertBefore(lens, img);
            /* Calculate the ratio between result DIV and lens: */
            cx = result.offsetWidth / lens.offsetWidth;
            cy = result.offsetHeight / lens.offsetHeight;
            /* Set background properties for the result DIV */
            result.style.backgroundImage = "url('" + zoomedImg.getAttribute('data-img') + "')";
            result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
            /* Execute a function when someone moves the cursor over the image, or the lens: */
            lens.addEventListener("mousemove", moveLens);
            img.addEventListener("mousemove", moveLens);
            /* And also for touch screens: */
            lens.addEventListener("touchmove", moveLens);
            img.addEventListener("touchmove", moveLens);
            /* terminate when mose leave lens */
            lens.addEventListener("mouseleave", terminateLens);
            lens.addEventListener("mouseout", terminateLens);
            lens.addEventListener("mouseup", terminateLens);


            function terminateLens() {
                result.classList.remove('available');
                lens.parentNode.removeChild(lens);
                return false;
            }

            function moveLens(e) {
                var pos, x, y;
                /* Prevent any other actions that may occur when moving over the image */
                e.preventDefault();
                /* Get the cursor's x and y positions: */
                pos = getCursorPos(e);
                /* Calculate the position of the lens: */
                x = pos.x - (lens.offsetWidth / 2);
                y = pos.y - (lens.offsetHeight / 2);
                /* Prevent the lens from being positioned outside the image: */
                if (x > img.width - lens.offsetWidth) {
                    x = img.width - lens.offsetWidth;
                }
                if (x < 0) {
                    x = 0;
                }
                if (y > img.height - lens.offsetHeight) {
                    y = img.height - lens.offsetHeight;
                }
                if (y < 0) {
                    y = 0;
                }
                /* Set the position of the lens: */
                lens.style.left = x + "px";
                lens.style.top = y + "px";
                /* Display what the lens "sees": */
                result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
            }

            function getCursorPos(e) {
                var a, x = 0, y = 0;
                e = e || window.event;
                /* Get the x and y positions of the image: */
                a = img.getBoundingClientRect();
                /* Calculate the cursor's x and y coordinates, relative to the image: */
                x = e.pageX - a.left;
                y = e.pageY - a.top;
                /* Consider any page scrolling: */
                x = x - window.pageXOffset;
                y = y - window.pageYOffset;
                return {x: x, y: y};
            }
        }

        // rating stars
        $('div.stars-inner').each(function () {
            var rating = $(this).attr('data-rating');
            $(this).css('width', rating + "%");
        });
        // input rating
        $("div.select-rating").click(function () {
            var value=$(this).attr('data-alt');
            var input=$('input#rating');
            var form=$(this).closest('form');
            $(this).addClass('active');
            input.attr('value',value);
            form.submit();
        });
    </script>
@endsection