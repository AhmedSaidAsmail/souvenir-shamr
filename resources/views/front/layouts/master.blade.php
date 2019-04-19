<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
</head>
<body>
<div class="body-wrapper">
    @include('front.layouts._side_nav')
    <div class="content-wrapper">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 left-nav">
                        <ul class="nav">
                            <li class="nav-item"><i class="fas fa-shipping-fast"></i> Fast shipping</li>
                            <li class="nav-item"><i class="fas fa-sync-alt"></i> Free return</li>
                            <li class="nav-item">
                                <a href="">
                                    <i class="far fa-question-circle"></i> Help
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-6 search-nav">
                        <input class="form-control" placeholder="What are looking for?">
                        <button><i class="icon ion-md-search"></i></button>
                    </div>
                    <div class="col-md-3 right-nav">
                        <ul class="nav justify-content-end">
                            <li class="nav-item">Languages <i class="icon ion-md-arrow-dropdown"></i></li>
                            <li class="nav-item">Sign In<i class="icon ion-md-arrow-dropdown"></i></li>
                            <li class="nav-item shopping-cart">
                                <div class="cart-badge">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <span class="number">10</span>
                                <span>cart</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-nav">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item logo">
                        <a href="">
                            <img src="images/logo.jpg" alt="">
                        </a>
                    </li>
                    <li class="nav-item all-categories">
                        <a href="" class="nav-link mob-menu-icon-wrapper">
                            <span>All <b>Categories</b></span>
                            <div class="mob-menu-icon">
                                <div class="hamburger"></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Gifts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Souvenir & Gifts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Fashion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Animals Care
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Beauty & Fragrance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            Tickets
                        </a>
                    </li>
                    <li class="nav-item mob-logo">
                        <a href="">
                            <img src="images/logo.jpg" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="banner">
            <!--<img src="images/m_generic_01-desktop_gw-d-uk-1500x600._CB481580320_.jpg">-->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/UK_GRD_DesktopHero_1500x600_v1._CB483365719_.jpg"
                             alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/Ship45EN_1X._CB454091417_.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/m_generic_01-desktop_gw-d-uk-1500x600._CB481580320_.jpg"
                             alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <i class="fas fa-chevron-left"></i>

                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <i class="fas fa-chevron-right"></i>

                </a>
            </div>
        </div>
        <div class="welcome-container">
            <div class="container">
                <div class="upper-wrapper">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="welcome-upper-ref">
                                <div class="ref-part">
                                    <div class="ref-part-title">
                                        <span>FAST</span>
                                        <span>SHIPPING</span>
                                    </div>
                                    <div class="ref-part-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                </div>
                                <div class="ref-part">
                                    <h3>same day delivery</h3>
                                    <p>order by 6pm. terms apply</p>
                                </div>
                                <div class="ref-part">
                                    <p class="single-line">only $3.95</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="welcome-upper-ref">
                                <div class="ref-part">
                                    <div class="ref-part-title">
                                        <span>click &</span>
                                        <span>collect</span>
                                    </div>
                                </div>
                                <div class="ref-part">
                                    <h3>pay online now or pay</h3>
                                    <h3>when you deliver your products</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="welcome-upper-ref">
                                <div class="ref-part">
                                    <div class="ref-part-title">
                                        <span>free</span>
                                        <span>return</span>
                                    </div>
                                    <div class="ref-part-icon">
                                        <i class="fas fa-sync"></i>
                                    </div>
                                </div>
                                <div class="ref-part">
                                    <h3>free return products on</h3>
                                    <h3>first 48 hours</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="upper-item">
                                <a href=""><img src="images/1419-block9-home-brand.jfif"> </a>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="upper-item">
                                <a href=""><img src="images/1419-block10-etk.jfif"> </a>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="upper-item">
                                <a href=""><img src="images/1419_block8_tusale.jfif"> </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product-list">
                        <h1>Recommended For You</h1>
                        <div class="products-list-wrapper">
                            <span class="list-control-prev unavailable">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="list-control-next">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <div class="product-list-row">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
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
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
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
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="products">
                                            <div class="product-img">
                                                <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                            </div>
                                            <div class="product-text">
                                                <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                                <div class="row">
                                                    <div class="col-md-8 product-price">
                                                        <div class="discount-wrapper">
                                                            usd 109.00
                                                            <span>7% off</span>
                                                        </div>
                                                        usd 105.00
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <div class="add-to-cart-wrapper">
                                                            <i class="fas fa-cart-plus"></i>
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
                </div>
                <div class="row">
                    <div class="info-holder">
                        <img src="images/Free-Shipping-en.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="category-holder">
                        <img src="images/Grocery-en.jpg" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="category-holder">
                        <img src="images/01Automotive-EN.jpg" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="product-list">
                        <h1>Most popular</h1>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product-list">
                        <h1>Top picks in souvenir</h1>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N15481248A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N11963549A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Mi Band 3 Fitness Tracker 110 mAh Black</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N19754163A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Samsung Galaxy Note9 Dual SIM Ocean Blue ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="products">
                                    <div class="product-img">
                                        <img src="images/products/thumb/N17819407A_1.jpg" alt="">
                                    </div>
                                    <div class="product-text">
                                        <h2>Watch Series 4 GPS With Sport Band Spac ..</h2>
                                        <div class="row">
                                            <div class="col-md-8 product-price">
                                                <div class="discount-wrapper">
                                                    usd 109.00
                                                    <span>7% off</span>
                                                </div>
                                                usd 105.00
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="add-to-cart-wrapper">
                                                    <i class="fas fa-cart-plus"></i>
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
        </div>
        <div class="footer">
            <div class="container">
                <div class="footer-links-wrapper row">
                    <div class="footer-links col-md-3">
                        <h3>Get to Know Us</h3>
                        <ul>
                            <li>
                                <a href="" class="nav_a">Careers</a>
                            </li>
                            <li>
                                <a href="">Blog</a>
                            </li>
                            <li>
                                <a href="">About SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Investor Relations</a>
                            </li>
                            <li>
                                <a href="">SouvenirSharm Devices</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>Make Money with Us</h3>
                        <ul>
                            <li>
                                <a href="">Sell on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Sell Your Services on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Sell on SouvenirSharm Business</a>
                            </li>
                            <li>
                                <a href="">Sell Your Apps on SouvenirSharm</a>
                            </li>
                            <li>
                                <a href="">Become an Affiliate</a>
                            </li>
                            <li>
                                <a href="">Advertise Your Products</a>
                            </li>
                            <li>
                                <a href="">Self-Publish with Us</a>
                            </li>
                            <li>
                                <a href="">See all</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>SouvenirSharm Payment Products</h3>
                        <ul>
                            <li>
                                <a href="">SouvenirSharm Business Card</a>
                            </li>
                            <li>
                                <a href="">Shop with Points</a>
                            </li>
                            <li>
                                <a href="">Reload Your Balance</a>
                            </li>
                            <li>
                                <a href="">SouvenirSharm Currency Converter</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-md-3">
                        <h3>Let Us Help You</h3>
                        <ul>
                            <li>
                                <a href="">Your Account</a>
                            </li>
                            <li>
                                <a href="">Your Orders</a>
                            </li>
                            <li>
                                <a href="">Shipping Rates & Policies</a>
                            </li>
                            <li>
                                <a href="">Returns & Replacements</a>
                            </li>
                            <li>
                                <a href="">Manage Your Content and Devices</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-ref">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 social-media text-center">
                            <span>follow us on</span>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="col-md-4 languages text-center">
                            <span>languages</span>
                            <a href=""><img src="images/en-flag.jpg"> </a>
                            <a href=""><img src="images/eg-flag.jpg"> </a>
                            <a href=""><img src="images/ru-flag.jpg"> </a>
                            <a href=""><img src="images/it-flag.jpg"> </a>
                        </div>
                        <div class="col-md-4 payment-methods text-center">
                            <span>payment methods</span>
                            <i class="fas fa-money-bill-wave"></i>
                            <i class="fab fa-paypal"></i>
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copy-rights text-center">
                &copy; 2019 souvenirsharm.com, powered py <a href="mailto:info.matrixcode@gmail.com"> Matrix Code</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@yield('javascript')
<script>
    // scroll list
    $(".list-control-next").click(function () {
        var parent = $(this).closest('.products-list-wrapper');
        var list = parent.find('.product-list-row');
        var row = list.find('.row');
        var row_scroll_width = parseInt(row[0].scrollWidth);
        var offset = list.scrollLeft();
        var true_offset = parseInt(offset) + list.width() + 15;
        var prev_elm = parent.find('.list-control-prev');

        if (true_offset < row_scroll_width) {
            if (true_offset + list.width() > row_scroll_width) {
                $(this).addClass('unavailable');
            }
            if (prev_elm.hasClass('unavailable')) {
                prev_elm.removeClass('unavailable');
            }
            offset = offset + list.width();
            list.animate({scrollLeft: offset}, 500);
            return true;
        }


    });
    $(".list-control-prev").click(function () {
        var parent = $(this).closest('.products-list-wrapper');
        var list = parent.find('.product-list-row');
        var offset = list.scrollLeft();
        var next_elm = parent.find('.list-control-next');
        if (offset > 0) {
            if (offset < list.width()) {
                $(this).addClass('unavailable');
            }
            if (next_elm.hasClass('unavailable')) {
                next_elm.removeClass('unavailable');
            }
            offset = offset - list.width();
            console.log(offset);
            list.animate({scrollLeft: offset}, 500);
            return true;
        }
    });
</script>
</body>
</html>