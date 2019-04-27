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
    <div class="loading-category-filters">
    </div>
    <section class="content">
        @include('front.layouts._category_products')
    </section>
@endsection
@section('javascript')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js"></script>
    <script>
        category();

        function category() {
            var loading = $(".loading-category-filters");
            var content_section = $("section.content");
            var container = $(".category-container");
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
            // rating stars
            $('div.stars-inner').each(function () {
                var rating = $(this).attr('data-rating');
                $(this).css('width', rating + "%");
            });
            $("input.ajax-check").change(function () {
                var form = $(this).closest('form');
                var data = form.serializeArray();
                var url = form.attr('action');
                loading.show();
                container.remove();
                $("html, body").animate({scrollTop: 0}, "slow");
                $.ajax({
                    type: "get",
                    url: url,
                    data: data,
                    success: function (response) {
                        content_section.html(response);
                        loading.hide();
                        category();
                    }
                });
            });
        }
    </script>
@endsection