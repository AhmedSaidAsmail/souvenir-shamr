@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Edit</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card form-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>Update {{$category->en_name}}</h2>
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
                            <a class="nav-item nav-link active" id="nav-category-basic-tab" data-toggle="tab"
                               href="#nav-category-basic"
                               role="tab" aria-controls="nav-category-basic" aria-selected="true">
                                Category details
                            </a>
                            <a class="nav-item nav-link" id="nav-meta-tab" data-toggle="tab" href="#nav-meta"
                               role="tab" aria-controls="nav-meta" aria-selected="false">
                                Meta Tags
                            </a>
                            <a class="nav-item nav-link" id="nav-brands-tab" data-toggle="tab" href="#nav-brands"
                               role="tab" aria-controls="nav-brands" aria-selected="false">
                                Brands
                            </a>
                            <a class="nav-item nav-link" id="nav-filters-tab" data-toggle="tab" href="#nav-filters"
                               role="tab" aria-controls="nav-filters" aria-selected="false">
                                Filters
                            </a>
                            <a class="nav-item nav-link" id="nav-home-link-tab" data-toggle="tab" href="#nav-home-link"
                               role="tab" aria-controls="nav-home-link" aria-selected="false">
                                Link
                            </a>

                        </div>
                    </nav>
                    <form method="post" id="basic_form"
                          action="{{route('admin.categories.update',['id'=>$category->id])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-category-basic" role="tabpanel"
                                 aria-labelledby="nav-category-basic-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Section Name:</label>
                                            <select class="form-control" id="section_val"
                                                    name="category[basic][section_id]">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{$section->id}}" {{$category->section->id==$section->id?"selected":null}}>{{$section->en_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Parent:</label>
                                            <select class="form-control" id="parent_val"
                                                    name="category[basic][parent_id]" data-link="">
                                                <option value="">--- None ---</option>
                                                @foreach ($categories as $list_category)
                                                    <option value="{{$list_category->id}}"
                                                            {{isset($category->parent)&&$category->parent->id==$list_category->id?"selected":null}}>{{$list_category->fullName('en_name')}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Group name</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="category[basic][en_name]" class="form-control"
                                                       placeholder="English name" value="{{$category->en_name}}"
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
                                                <input type="text" name="category[basic][ar_name]" class="form-control"
                                                       placeholder="Arabic name" value="{{$category->ar_name}}"
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
                                                <input type="text" name="category[basic][ru_name]" class="form-control"
                                                       placeholder="Russian name" value="{{$category->ru_name}}"
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
                                                <input type="text" name="category[basic][it_name]" class="form-control"
                                                       placeholder="Italian name" value="{{$category->it_name}}"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="category[basic][status]" required>
                                                <option value="1">Confirmed</option>
                                                <option value="0" {{!$category->status?"selected":null}}>Pending
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sort order</label>
                                            <input type="number" class="form-control" name="category[basic][sort_order]"
                                                   value="{{$category->sort_order}}" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home shortcut</label>
                                            <select class="form-control" name="category[basic][home]">
                                                <option value="1">Confirmed</option>
                                                <option value="0" {{!$category->home?"selected":null}}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home sort order</label>
                                            <input type="number" class="form-control"
                                                   name="category[basic][home_sort_order]"
                                                   value="{{$category->home_sort_order}}">
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
                                                <input type="text" name="category[details][en_meta_title]"
                                                       class="form-control" placeholder="English name"
                                                       value="{{$category->detail->en_meta_title}}"
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
                                                <input type="text" name="category[details][ar_meta_title]"
                                                       class="form-control" placeholder="Arabic name"
                                                       value="{{$category->detail->ar_meta_title}}"
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
                                                <input type="text" name="category[details][ru_meta_title]"
                                                       class="form-control" placeholder="Russian name"
                                                       value="{{$category->detail->ru_meta_title}}"
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
                                                <input type="text" name="category[details][it_meta_title]"
                                                       class="form-control" placeholder="Italian name"
                                                       value="{{$category->detail->it_meta_title}}"
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
                                                <input type="text" name="category[details][en_meta_keywords]"
                                                       class="form-control" placeholder="English name"
                                                       value="{{$category->detail->en_meta_keywords}}"
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
                                                <input type="text" name="category[details][ar_meta_keywords]"
                                                       class="form-control" placeholder="Arabic name"
                                                       value="{{$category->detail->ar_meta_keywords}}"
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
                                                <input type="text" name="category[details][ru_meta_keywords]"
                                                       class="form-control" placeholder="Russian name"
                                                       value="{{$category->detail->ru_meta_keywords}}"
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
                                                <input type="text" name="category[details][it_meta_keywords]"
                                                       class="form-control" placeholder="Italian name"
                                                       value="{{$category->detail->it_meta_keywords}}"
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
                                                <input type="text" name="category[details][en_meta_description]"
                                                       class="form-control" placeholder="English name"
                                                       value="{{$category->detail->en_meta_description}}"
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
                                                <input type="text" name="category[details][ar_meta_description]"
                                                       class="form-control" placeholder="Arabic name"
                                                       value="{{$category->detail->ar_meta_description}}"
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
                                                <input type="text" name="category[details][ru_meta_description]"
                                                       class="form-control" placeholder="Russian name"
                                                       value="{{$category->detail->ru_meta_description}}"
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
                                                <input type="text" name="category[details][it_meta_description]"
                                                       class="form-control" placeholder="Italian name"
                                                       value="{{$category->detail->it_meta_description}}"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end meta tags --}}
                            {{-- brands --}}
                            <div class="tab-pane fade" id="nav-brands" role="tabpanel"
                                 aria-labelledby="nav-brands-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <select name="category[brands][]" class="form-control multi-choice"
                                                    data-link="{{route('admin.categories.brands',['id'=>$category->id])}}"
                                                    multiple="multiple" id="brands_val" style="width: 100%">
                                                <?php
                                                $brands_list = array_column($category->brands->toArray(), 'id');
                                                ?>
                                                @foreach($category->section->brands as $brand)
                                                    <option value="{{$brand->id}}" {{in_array($brand->id,$brands_list)?"selected":null}}>{{$brand->en_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end brands --}}
                            {{-- filters --}}
                            <div class="tab-pane fade" id="nav-filters" role="tabpanel"
                                 aria-labelledby="nav-filters-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <select name="category[filters][]" class="form-control multi-choice"
                                                    multiple="multiple" style="width: 100%">
                                                <?php
                                                $filter_list = array_column($category->filters->toArray(), 'id');
                                                ?>
                                                @foreach($filters as $filter)
                                                    <option value="{{$filter->id}}" {{in_array($filter->id,$filter_list)?"selected":null}}>{{$filter->en_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end filters --}}
                            {{-- home link --}}
                            <div class="tab-pane fade" id="nav-home-link" role="tabpanel"
                                 aria-labelledby="nav-home-link-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Header 1</label>
                                            <input name="category[link][header_1]" class="form-control"
                                                   value="{{$category->link->header_1}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Header 2</label>
                                            <input name="category[link][header_2]" class="form-control"
                                                   value="{{$category->link->header_2}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input name="category[link][link]" class="form-control"
                                                   value="{{$category->link->link}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end home link --}}
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
    <script>
        $('.multi-choice').select2();
    </script>
    <script>
        var section_val = $("#section_val");
        var parent_val = $("#parent_val");
        var brands_val = $("#brands_val");

        function getBrands() {
            var section = section_val.val();
            var category = parent_val.val();
            var url = brands_val.attr('data-link');
            $.ajax({
                url: url,
                type: "get",
                data: {section: section, category: category},
                success: function (response) {
                    brands_val.html(response);
                }
            });
        }

        section_val.change(function () {
            var val = $(this).val();
            if (val) {
                parent_val.prop('disabled', true);
                parent_val.prop('selectedIndex', 0);
                getBrands();
                return true;
            }
            parent_val.prop('disabled', false);
        });
        parent_val.change(function () {
            var val = $(this).val();
            if (val) {
                section_val.prop('disabled', true);
                section_val.prop('selectedIndex', 0);
                getBrands();
                return true;
            }
            section_val.prop('disabled', false);
        });
    </script>
@endsection