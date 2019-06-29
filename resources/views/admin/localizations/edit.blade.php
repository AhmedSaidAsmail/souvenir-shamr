@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Localizations</a>
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
                            <h2>Update Translating:{{$localization->word}}</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" form="basic_form"><i class="fas fa-save"></i></button>
                            <a class="btn btn-primary" href="{{URL::previous()}}"><i class="fas fa-reply-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.localization.update',['id'=>$localization->id])}}" id="basic_form">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Word</label>
                                    <input class="form-control" name="word" value="{{$localization->word}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Translating </label>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="en_name">
                                                    <img src="{{asset('images/panel/en-flag.jpg')}}">
                                                </span>
                                        </div>
                                        <input type="text" name="word_en" class="form-control"
                                               placeholder="English name" value="{{$localization->word_en}}"
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
                                        <input type="text" name="word_ar" class="form-control"
                                               placeholder="Arabic name" value="{{$localization->word_ar}}"
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
                                        <input type="text" name="word_ru" class="form-control"
                                               placeholder="Russian name" value="{{$localization->word_ru}}"
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
                                        <input type="text" name="word_it" class="form-control"
                                               placeholder="Italian name" value="{{$localization->word_it}}"
                                               aria-label="Username" aria-describedby="it_name" required>
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
@endsection
