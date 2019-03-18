@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Sections</a>
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
                            <h2>Update section</h2>
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
                                Section
                            </a>
                            <a class="nav-item nav-link" id="nav-additional-tab" data-toggle="tab"
                               href="#nav-additional"
                               role="tab" aria-controls="nav-additional" aria-selected="false">
                                Home shortcut
                            </a>
                            <a class="nav-item nav-link" id="nav-brands-tab" data-toggle="tab" href="#nav-brands"
                               role="tab" aria-controls="nav-brands" aria-selected="false">
                                Brands
                            </a>
                            <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details"
                               role="tab" aria-controls="nav-filters" aria-selected="false">
                                Meta Tags
                            </a>

                        </div>
                    </nav>
                    <form method="post" id="basic_form" action="{{route('admin.sections.update',['id'=>$section->id])}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">
                                <div class="form-group">
                                    <label>Section name</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[basic][en_name]" class="form-control"
                                                       placeholder="English name" value="{{$section->en_name}}"
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
                                                <input type="text" name="section[basic][ar_name]" class="form-control"
                                                       placeholder="Arabic name" value="{{$section->ar_name}}"
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
                                                <input type="text" name="section[basic][ru_name]" class="form-control"
                                                       placeholder="Russian name" value="{{$section->ru_name}}"
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
                                                <input type="text" name="section[basic][it_name]" class="form-control"
                                                       placeholder="Italian name" value="{{$section->it_name}}"
                                                       aria-label="Username" aria-describedby="it_name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="section[basic][status]" required>
                                                <option value="1">Confirmed</option>
                                                <option value="0" {{!$section->status?"selected":null}}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sort order</label>
                                            <input type="number" class="form-control" name="section[basic][sort_order]"
                                                   value="{{$section->sort_order}}" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Symbol</label>
                                            <input class="form-control" value="{{$section->symbol}}"
                                                   name="section[basic][symbol]" list="symbols">
                                            <datalist id="symbols">
                                                <option value="fas fa-mobile-alt">Phones</option>
                                                <option value="fas fa-tv">Tv</option>
                                                <option value="fas fa-laptop">Laptop</option>
                                                <option value="fas fa-baby-carriage">Baby</option>
                                                <option value="fas fa-home">Home</option>
                                                <option value="fas fa-ankh">Souvenir</option>
                                                <option value="fas fa-paw">Animals</option>
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" class="form-control" name="section[basic][banner_img]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="nav-additional" role="tabpanel"
                                 aria-labelledby="nav-additional-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home shortcut</label>
                                            <select class="form-control" name="section[basic][home]" required>
                                                <option value="1">Confirmed</option>
                                                <option value="0" {{!$section->home?"selected":null}}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home sort order</label>
                                            <input type="number" class="form-control"
                                                   name="section[basic][home_sort_order]" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Home Image</label>
                                            <input type="file" class="form-control" name="section[basic][home_img]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-brands" role="tabpanel"
                                 aria-labelledby="nav-brands-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <select name="section[brand][]" class="form-control multi-choice"
                                                    multiple="multiple" style="width: 100%">
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}"
                                                            {{$section->brandFilter($brand->id)?"selected":null}}>{{$brand->en_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-details" role="tabpanel"
                                 aria-labelledby="nav-details-tab">
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
                                                <input type="text" name="section[details][en_meta_title]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name"
                                                       value="{{$section->detail->en_meta_title}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ar_meta_title]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name"
                                                       value="{{$section->detail->ar_meta_title}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ru_meta_title]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name"
                                                       value="{{$section->detail->ru_meta_title}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][it_meta_title]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name"
                                                       value="{{$section->detail->ru_meta_title}}" required>
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
                                                <input type="text" name="section[details][en_meta_keywords]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name"
                                                       value="{{$section->detail->en_meta_keywords}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ar_meta_keywords]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name"
                                                       value="{{$section->detail->ar_meta_keywords}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ru_meta_keywords]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name"
                                                       value="{{$section->detail->ru_meta_keywords}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][it_meta_keywords]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name"
                                                       value="{{$section->detail->it_meta_keywords}}" required>
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
                                                <input type="text" name="section[details][en_meta_description]"
                                                       class="form-control" placeholder="English name"
                                                       aria-label="Username" aria-describedby="en_name"
                                                       value="{{$section->detail->en_meta_description}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ar_name">
                                                    <img src="{{asset('images/panel/eg-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ar_meta_description]"
                                                       class="form-control" placeholder="Arabic name"
                                                       aria-label="Username" aria-describedby="ar_name"
                                                       value="{{$section->detail->ar_meta_description}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="ru_name">
                                                    <img src="{{asset('images/panel/ru-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][ru_meta_description]"
                                                       class="form-control" placeholder="Russian name"
                                                       aria-label="Username" aria-describedby="ru_name"
                                                       value="{{$section->detail->ru_meta_description}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="it_name">
                                                    <img src="{{asset('images/panel/it-flag.jpg')}}">
                                                </span>
                                                </div>
                                                <input type="text" name="section[details][it_meta_description]"
                                                       class="form-control" placeholder="Italian name"
                                                       aria-label="Username" aria-describedby="it_name"
                                                       value="{{$section->detail->it_meta_description}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection