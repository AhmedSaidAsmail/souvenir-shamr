@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Brands</a>
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
                            <h2>Add new brand</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" form="basic_form"><i class="fas fa-save"></i></button>
                            <a class="btn btn-primary" href="{{URL::previous()}}"><i class="fas fa-reply-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.brands.store')}}" id="basic_form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Brand name <i class="fas fa-trademark"></i></label>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                        </div>
                                        <input type="text" name="brand[en_name]" class="form-control"
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
                                        <input type="text" name="brand[ar_name]" class="form-control"
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
                                        <input type="text" name="brand[ru_name]" class="form-control"
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
                                        <input type="text" name="brand[it_name]" class="form-control"
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
                                    <select class="form-control" name="brand[status]" required>
                                        <option value="1" selected>Confirmed</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sort order</label>
                                    <input type="number" class="form-control" name="brand[sort_order]"
                                           value="0"
                                           required>
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
@endsection
