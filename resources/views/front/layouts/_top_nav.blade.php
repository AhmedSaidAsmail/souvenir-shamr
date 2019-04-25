<div class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-3 left-nav">
                <ul class="nav">
                    <li class="nav-item"><i class="fas fa-shipping-fast"></i> {{translate('Fast shipping')}}</li>
                    <li class="nav-item"><i class="fas fa-sync-alt"></i> {{translate('Free return')}}</li>
                    <li class="nav-item">
                        <a href="">
                            <i class="far fa-question-circle"></i> Help
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-md-6 search-nav">
                <input class="form-control" placeholder="{{translate('What are looking for?')}}">
                <button><i class="icon ion-md-search"></i></button>
            </div>
            <div class="col-md-3 right-nav">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        {{translate('Languages')}} <i class="icon ion-md-arrow-dropdown"></i>
                    </li>
                    <li class="nav-item">
                        {{translate('Sign In')}}<i class="icon ion-md-arrow-dropdown"></i>
                    </li>
                    <li class="nav-item shopping-cart">
                        <div class="cart-badge">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span class="number">10</span>
                        <span>{{translate('cart')}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>