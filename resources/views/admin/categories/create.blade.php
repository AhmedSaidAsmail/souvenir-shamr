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
                    <form method="post" id="basic_form" action="{{route('admin.categories.store')}}">
                        {{csrf_field()}}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-category-basic" role="tabpanel"
                                 aria-labelledby="nav-category-basic-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Section Name:</label>
                                            <select class="form-control" id="section_val"
                                                    name="category[basic][section_id" ] data-link="">
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{$section->id}}">{{$section->en_name}}</option>
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
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->fullName('en_name')}}</option>
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
                                                <input type="text" name="category[basic][ar_name]" class="form-control"
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
                                                <input type="text" name="category[basic][ru_name]" class="form-control"
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
                                                <input type="text" name="category[basic][it_name]" class="form-control"
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
                                            <select class="form-control" name="category[basic][status]" required>
                                                <option value="1" selected>Confirmed</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sort order</label>
                                            <input type="number" class="form-control" name="category[basic][sort_order]"
                                                   value="0" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home shortcut</label>
                                            <select class="form-control" name="category[basic][home]">
                                                <option value="1" selected>Confirmed</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home sort order</label>
                                            <input type="number" class="form-control"
                                                   name="category[basic][home_sort_order]" value="0">
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
                                                    multiple="multiple" id="brands_val" style="width: 100%">
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
                                                @foreach($filters as $filter)
                                                    <option value="{{$filter->id}}">{{$filter->en_name}}</option>
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
                                            <input name="category[link]header_1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Header 2</label>
                                            <input name="category[link]header_2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input name="category[link]link" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end home link --}}
                        </div>
                    </form>
                    <form method="post" action="#" id="hasmany_form">

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
        var section_va = $("#section_val");
        var parent_val = $("#parent_val");
    </script>
    <script>
        var html = function (data, index) {
            return '<tr data-index="' + index + '">\n' +
                '  <td><input name="filters[items][' + index + '][en_name]" value="' + data.add_en_name + '" required></td>\n' +
                '  <td><input name="filters[items][' + index + '][ar_name]" value="' + data.add_ar_name + '" required></td>\n' +
                '  <td><input name="filters[items][' + index + '][ru_name]" value="' + data.add_ru_name + '" required></td>\n' +
                '  <td><input name="filters[items][' + index + '][it_name]" value="' + data.add_it_name + '" required></td>\n' +
                '  <td><input type="number" name="filters[items][' + index + '][sort_order]" value="' + data.add_sort_order + '" required></td>\n' +
                '  <td><a href="#" class="remove-row text-danger"><i class="fas fa-backspace"></i></a>\n' +
                '  </td>\n' +
                '</tr>'

        };
        $("form#hasmany_form").submit(function (event) {
            event.preventDefault();
            var data = arrayConverting($(this).serializeArray());
            var table = $("table.hasmany-wrapper");
            table.find('tbody').append(html(data, indexResolving(table)));
            removeRow();
        });
        removeRow();

        function arrayConverting(fields) {
            var dataArray = new Array();
            jQuery.each(fields, function (i, field) {
                dataArray[field.name] = field.value;
            });
            return dataArray;
        }

        function indexResolving(table) {
            var rows = table.find('tr[data-index]').toArray();
            var index = null;
            jQuery.each(rows, function (i, row) {
                var row_index = parseInt(row.attributes["data-index"]["nodeValue"]);
                if (row_index > index) {
                    index = row_index;
                }
                if (row_index === 0) {
                    index = 0;
                }
            });
            return index === null ? 0 : index + 1;
        }

        function removeRow() {
            $("a.remove-row").click(function (event) {
                event.preventDefault();
                var row = $(this).closest('tr');
                row.remove();
            });
        }
    </script>
@endsection