@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Filters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Edite</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card form-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>Update filter {{$filter->en_name}}</h2>
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
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                               role="tab" aria-controls="nav-home" aria-selected="true">
                                Filters Group
                            </a>
                            <a class="nav-item nav-link" id="nav-filters-tab" data-toggle="tab" href="#nav-filters"
                               role="tab" aria-controls="nav-filters" aria-selected="false">
                                Filters
                            </a>

                        </div>
                    </nav>
                    <form method="post" id="basic_form" action="{{route('admin.filters.update',['id'=>$filter->id])}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">
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
                                                <input type="text" name="filters[basic][en_name]" class="form-control"
                                                       placeholder="English name" value="{{$filter->en_name}}"
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
                                                <input type="text" name="filters[basic][ar_name]" class="form-control"
                                                       placeholder="Arabic name" value="{{$filter->ar_name}}"
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
                                                <input type="text" name="filters[basic][ru_name]" class="form-control"
                                                       placeholder="Russian name" value="{{$filter->ru_name}}"
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
                                                <input type="text" name="filters[basic][it_name]" class="form-control"
                                                       placeholder="Italian name" value="{{$filter->it_name}}"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="filters[basic][status]" required>
                                                <option value="1">Confirmed</option>
                                                <option value="0" {!! !$filter->status?"selected":null !!}>Pending
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sort order</label>
                                            <input type="number" class="form-control" name="filters[basic][sort_order]"
                                                   value="{{$filter->sort_order}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-filters" role="tabpanel"
                                 aria-labelledby="nav-filters-tab">
                                <section class="hasmany-rows">
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
                                                    <input type="text" name="add_en_name" form="hasmany_form"
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
                                                    <input type="text" name="add_ar_name" form="hasmany_form"
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
                                                    <input type="text" name="add_ru_name" form="hasmany_form"
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
                                                    <input type="text" name="add_it_name" form="hasmany_form"
                                                           class="form-control" placeholder="Italian name"
                                                           aria-label="Username" aria-describedby="it_name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <input type="number" value="0" class="form-control"
                                                       name="add_sort_order"
                                                       form="hasmany_form" placeholder="Sort order: only numbers"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-warning btn-block add-row" form="hasmany_form">
                                        <i class="fas fa-plus-circle"></i> Add row
                                    </button>
                                </section>
                                <table class="table hasmany-wrapper">
                                    <thead>
                                    <tr>
                                        <th>En name</th>
                                        <th>Ar name</th>
                                        <th>Ru name</th>
                                        <th>It name</th>
                                        <th>Sort order</th>
                                        <th>#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($filter->items as $item)
                                        <?php
                                        $index = $item->id;
                                        ?>
                                        <tr data-index="{{$index}}">
                                            <td>
                                                <input type="hidden" name="filters[items][{{$index}}][id]"
                                                       value="{{$index}}">
                                                <input name="filters[items][{{$index}}][en_name]" value="{{$item->en_name}}"
                                                       required="">
                                            </td>
                                            <td>
                                                <input name="filters[items][{{$index}}][ar_name]"
                                                       value="{{$item->ar_name}}" required="">
                                            </td>
                                            <td>
                                                <input name="filters[items][{{$index}}][ru_name]" value="{{$item->ru_name}}"
                                                       required="">
                                            </td>
                                            <td>
                                                <input name="filters[items][{{$index}}][it_name]" value="{{$item->it_name}}"
                                                       required="">
                                            </td>
                                            <td>
                                                <input type="number" name="filters[items][{{$index}}][sort_order]"
                                                       value="{{$item->sort_order}}" required="">
                                            </td>
                                            <td>
                                                <a href="#" class="remove-row text-danger">
                                                    <i class="fas fa-backspace"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- Filters items  --}}
                                    </tbody>
                                </table>
                            </div>
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
@endsection
@section('javascript')
    @parent
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
            $(this).trigger("reset");
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