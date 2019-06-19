@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Hotels</a>
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
                            <h2>Add new hotel</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" form="basic_form"><i class="fas fa-save"></i></button>
                            <a class="btn btn-primary" href="{{URL::previous()}}"><i class="fas fa-reply-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.hotels.store')}}" id="basic_form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Hotel Name</label>
                                    <input class="form-control" name="hotel" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input  class="form-control" name="address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" name="city" value="Sharm El Sheikh" readonly required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="country" value="Egypt" readonly required>
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
