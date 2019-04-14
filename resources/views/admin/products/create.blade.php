@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Create</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card form-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>Add new category</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" form="basic_form"><i class="fas fa-save"></i></button>
                            <a class="btn btn-primary" href="{{URL::previous()}}"><i class="fas fa-reply-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-product-basic-tab" data-toggle="tab"
                               href="#nav-product-basic"
                               role="tab" aria-controls="nav-product-basic" aria-selected="true">
                                Product details
                            </a>
                            <a class="nav-item nav-link" id="nav-meta-tab" data-toggle="tab" href="#nav-meta"
                               role="tab" aria-controls="nav-meta" aria-selected="false">
                                Meta Tags
                            </a>
                            <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab"
                               href="#nav-description"
                               role="tab" aria-controls="nav-description" aria-selected="false">
                                Descriptions
                            </a>


                            <a class="nav-item nav-link" id="nav-filters-tab" data-toggle="tab" href="#nav-filters"
                               role="tab" aria-controls="nav-filters" aria-selected="false">
                                Filters
                            </a>

                        </div>
                    </nav>
                    <form method="post" id="basic_form" action="{{route('admin.products.store')}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-product-basic" role="tabpanel"
                                 aria-labelledby="nav-product-basic-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Category:</label>
                                            <select class="form-control" id="category_input"
                                                    name="product[basic][category_id]" required>
                                                <option value="">--- None ---</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->fullName('en_name')}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="product[basic][brand_id]" id="brands_selection"
                                                    class="form-control" data-link="{{route('admin.products.brands')}}"
                                                    required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <input name="product[basic][model]" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="product[basic][vendor_id]" class="form-control" required>
                                                <option value="">Select a vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product name</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[basic][en_name]" class="form-control"
                                                       placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[basic][ar_name]" class="form-control"
                                                       placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[basic][ru_name]" class="form-control"
                                                       placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[basic][it_name]" class="form-control"
                                                       placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="product[basic][status]" required>
                                                <option value="1" selected>Confirmed</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sort order</label>
                                            <input type="number" class="form-control" name="product[basic][sort_order]"
                                                   value="0" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control"
                                                   name="product[basic][price]" min="1" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Shipping</label>
                                            <select class="form-control" name="product[basic][shipping]">
                                                <option value="1">true</option>
                                                <option value="0">false</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="product[basic][img]" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="product[basic][quantity]"
                                                   value="0" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Minimum quantity</label>
                                            <input type="number" class="form-control"
                                                   name="product[basic][min_quantity]" min="1" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Available date</label>
                                            <input value="{{\Carbon\Carbon::today()->format('Y-m-d')}}"
                                                   class="form-control"
                                                   name="product[basic][date_available]" dataformatas="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- meta tags --}}
                            <div class="tab-pane fade" id="nav-meta" role="tabpanel"
                                 aria-labelledby="nav-meta-tab">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][en_meta_title]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ar_meta_title]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ru_meta_title]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][it_meta_title]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][en_meta_keywords]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ar_meta_keywords]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ru_meta_keywords]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][it_meta_keywords]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][en_meta_description]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ar_meta_description]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][ru_meta_description]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="product[details][it_meta_description]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end meta tags --}}
                            {{-- description --}}
                            <div class="tab-pane fade" id="nav-description" role="tabpanel"
                                 aria-labelledby="nav-description-tab">
                                <div class="form-group">
                                    <label>English description</label>
                                    <textarea id="editor" name="product[description][en_description]"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Arabic description</label>
                                    <textarea id="editor_2" name="product[description][ar_description]"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Russian description</label>
                                    <textarea id="editor_3" name="product[description][ru_description]"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Italian description</label>
                                    <textarea id="editor_4" name="product[description][it_description]"></textarea>
                                </div>
                            </div>
                            {{-- end description --}}
                            {{-- filters --}}
                            <div class="tab-pane fade" id="nav-filters" role="tabpanel"
                                 aria-labelledby="nav-filters-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Filters</label>
                                            <select class="form-control" id="filter_selection"
                                                    data-link="{{route('admin.products.filters')}}">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <section id="filters_area" data-link="{{route('admin.products.filters.items')}}">
                                    {{-- filters --}}
                                </section>

                            </div>
                            {{-- end filters --}}
                        </div>
                    </form>
                </div>
            </div>

        </section>


    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/panel/form.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
@endsection
@section('javascript')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'));
        ClassicEditor.create(document.querySelector('#editor_2'));
        ClassicEditor.create(document.querySelector('#editor_3'));
        ClassicEditor.create(document.querySelector('#editor_4'));
    </script>
    <script>
        // text editor

        // select 2
        $('.multi-choice').select2();
    </script>
    <script>
        var category_input = $("#category_input");
        var brands_selection = $("#brands_selection");
        var filter_selection = $("#filter_selection");

        function getBrands() {
            var category = category_input.val();
            var url = brands_selection.attr('data-link') + "/" + category;
            $.ajax({
                url: url,
                type: "get",
                success: function (response) {
                    brands_selection.html(response);
                }
            });
        }

        function getFilters() {
            var category = category_input.val();
            var url = filter_selection.attr('data-link') + "/" + category;
            $.ajax({
                url: url,
                type: "get",
                success: function (response) {
                    filter_selection.html(response);
                }
            });
        }


        category_input.change(function () {
            var val = $(this).val();
            if (val) {
                getBrands();
                getFilters();
                return true;
            }
            brands_selection.empty();
        });
    </script>
    <script>
        var filters_section = $("section#filters_area");
        removeFilter();
        $("#filter_selection").change(function () {
            var val = $(this).val();
            var url = filters_section.attr('data-link') + "/" + val;
            if (filterIsExists(val)) {
                $.ajax({
                    url: url,
                    type: "get",
                    success: function (response) {
                        filters_section.append(response);
                        removeFilter();
                        $('.multi-choice').select2();
                    }
                });
            } else {
                alert('Filter is already exists');
            }
        });

        // remove filter
        function removeFilter() {
            $("a.remove-filter").click(function (event) {
                event.preventDefault();
                $(this).closest('.card').remove();
            });
        }

        // check if filter already exists
        function filterIsExists(filter) {
            var result = true;
            filters_section.find(".card").each(function () {
                if ($(this).attr('tabindex') === filter) {
                    result = false;
                }
            });
            return result;
        }
    </script>
@endsection