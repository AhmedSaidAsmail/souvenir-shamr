@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Settings</a>
            </li>
        </ul>
        <div class="row setting-wrapper">
            <div class="col-md-6">
                <a href="{{route('admin.settings.payment')}}" class="btn btn-block btn-primary">
                    <i class="fab fa-btc"></i> Payment Method
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{route('admin.localization.index')}}" class="btn btn-block btn-success">
                    <i class="fas fa-globe-americas"></i> Localization
                </a>
            </div>
        </div>
    </div>
@endsection