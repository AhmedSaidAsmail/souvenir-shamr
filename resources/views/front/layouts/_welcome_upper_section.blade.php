<div class="upper-wrapper">
    <div class="row">
        <div class="col-md-4">
            <div class="welcome-upper-ref">
                <div class="ref-part">
                    <div class="ref-part-title">
                        <span>{{translate('FAST')}}</span>
                        <span>{{translate('SHIPPING')}}</span>
                    </div>
                    <div class="ref-part-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
                <div class="ref-part">
                    <h3>{{translate('same day delivery')}}</h3>
                    <p>{{translate('order by 6pm. terms apply')}}</p>
                </div>
                <div class="ref-part">
                    <p class="single-line">{{translate('only $3.95')}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="welcome-upper-ref">
                <div class="ref-part">
                    <div class="ref-part-title">
                        <span>{{translate('click &')}}</span>
                        <span>{{translate('collect')}}</span>
                    </div>
                </div>
                <div class="ref-part">
                    <h3>{{translate('pay online now or pay')}}</h3>
                    <h3>{{translate('when you deliver your products')}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="welcome-upper-ref">
                <div class="ref-part">
                    <div class="ref-part-title">
                        <span>{{translate('free')}}</span>
                        <span>{{translate('return')}}</span>
                    </div>
                    <div class="ref-part-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                </div>
                <div class="ref-part">
                    <h3>{{translate('free return products on')}}</h3>
                    <h3>{{translate('first 48 hours')}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($recommended_categories as $category)
            <?php
            $category_parameters = [
                'lang' => $lang,
                'category_name' => translateModel($category,'name'),
                'id' => $category->id
            ]
            ?>
            <div class="col-md-4">
                <div class="upper-item">
                    <a href="{{route('home.category',$category_parameters)}}">
                        <img class="lazy" src="{{asset('images/loading.gif')}}"
                             data-src="{{asset('images/categories/'.$category->image)}}" alt="{{translateModel($category,'name')}}">
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</div>