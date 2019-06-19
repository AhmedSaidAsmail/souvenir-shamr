<div class="col-md-2">
    <?php
    $product_parameters = [
        'lang' => $lang,
        'name' => translateModel($product, 'name'),
        'id' => $product->id
    ]
    ?>
    <a href="{{route('home.product',$product_parameters)}}" class="product-link">
        <div class="products">
            <div class="product-img">
                <img class="lazy" src="{{asset('images/loading.gif')}}"
                     data-src="{{asset('images/products/thumbMd/'.$product->img)}}"
                     alt="{{translateModel($product,'name')}}">
            </div>
            <div class="product-text">
                {{--<h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>--}}
                <h2>{{str_limit(translateModel($product,'name'),42,'...')}}</h2>
                <div class="row">
                    <div class="col-8 product-price">
                        <div class="discount-wrapper">
                            usd 109.00
                            <span>7% off</span>
                        </div>
                        usd 105.00
                    </div>
                    <div class="col-4 text-right">
                        <div class="add-to-cart-wrapper">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>