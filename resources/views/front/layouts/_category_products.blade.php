<div class="category-container">
    <div class="container">
        <ul class="category-dir nav">
            <li class="nav-item">
                home
            </li>
            @foreach($category()->allParents() as $child)
                <li class="nav-item">
                    <a href="">
                        {{translateModel($child,'name')}}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="row">
            <div class="col-md-2 filter-column">
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
                                                <input type="checkbox" class="ajax-check" name="categories[]"
                                                       value="{{$child->id}}" {{inputIsChecked($request,'categories',$child->id)}}>
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
                                        <input type="checkbox" class="ajax-check" name="brand"
                                               value="{{$brand->id}}" {{inputIsChecked($request,'brand',$brand->id)}}>
                                        {{translateModel($brand(),'name')}}<span>({{$brand->count()}})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($category->filters() as $filter)
                        <div class="category-filter-section">
                            <h3>{{translateModel($filter(),'name')}}</h3>
                            <div class="filters-options">
                                @foreach($filter->items() as $item)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="ajax-check" name="filters[]"
                                                   value="{{$item->id}}" {{inputIsChecked($request,'filters',$item->id)}}>
                                            {{translateModel($item(),'name')}}<span>({{$item->count()}})</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="category-filter-section">
                        <?php
                        $min_price = $category->price()->min();
                        $max_price = $category->price()->max();
                        ?>
                        <h3>Price</h3>
                        <div class="filters-options">
                            <div class="row price-range-inputs">
                                <div class="col">
                                    <label>From ({{strtoupper(currency())}})</label>
                                    <input class="form-control" id="price_from" name="min_price"
                                           placeholder="{{$min_price}}">
                                </div>
                                <div class="col">
                                    <label>To ({{strtoupper(currency())}})</label>
                                    <input class="form-control" id="price_to" name="max_price"
                                           placeholder="{{$max_price}}">
                                </div>
                            </div>
                            <div class="price-range">
                                <input id="ex2" type="text" class="span2" value=""
                                       data-slider-min="{{$min_price}}"
                                       data-slider-max="{{$max_price}}" data-slider-step="5"
                                       data-slider-value="[{{$min_price}},{{$max_price}}]">
                            </div>
                            <button class="btn btn-warning btn-block">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-10">
                <div class="category-result-header">
                    {{$category->products()->count()}} results found for
                    <span>{{translateModel($category(),'name')}}</span>
                </div>
                <div class="category-list">
                    @foreach($category->products()->chunk(4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $product)
                                <div class="col-md-3">
                                    <div class="category-product">
                                        <div class="product-img">
                                            <img src="{{asset('images/products/thumb/'.$product->img)}}"
                                                 alt="{{translateModel($product,'name')}}">
                                        </div>
                                        <div class="product-text">
                                            <h2>{{translateModel($product,'name')}}</h2>
                                            <div class="product-footer">
                                                <div class="row">
                                                    <div class="col-6 product-price">
                                                        @if($product->price()['has_discount'])
                                                            <div class="discount-wrapper">
                                                                {{currency()}} {{number_format($product->price()['before'],2,'.',',')}}
                                                                <span>{{$product->price()['discount']}}% off</span>
                                                            </div>
                                                        @endif
                                                        {{currency()}} {{number_format($product->price()['price'],2,'.',',')}}
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <div class="stars-outer">
                                                            <div class="stars-inner"
                                                                 data-rating="{{overAllRatingPercentage($product)}}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="" class="btn btn-block">
                                                    <i class="fas fa-cart-plus"></i> add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>