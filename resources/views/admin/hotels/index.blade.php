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
                <a class="nav-link">Index</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card data-table-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>All Stored Hotels</h2>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('admin.hotels.create')}}" class="btn btn-primary addable">
                                <i class="fas fa-forward"></i> Add new hotel
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-customized" id="dataTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Hotel</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <td>{{$hotel->id}}</td>
                                <td>{{$hotel->hotel}}</td>
                                <td>{{$hotel->address}}</td>
                                <td>{{$hotel->city}}</td>
                                <td>{{$hotel->country}}</td>
                                <td class="actions">
                                    <a href="{{route('admin.hotels.edit',['id'=>$hotel->id])}}" class="editable">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <form action="{{route('admin.hotels.destroy',['id'=>$hotel->id])}}" method="post"
                                          id="delete_row">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="text-danger"><i class="fas fa-trash-restore"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


    </div>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/panel/data-table.css')}}">
@endsection
@section('javascript')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script>
        $('#dataTable').DataTable({
            "order": []
        });
        $('form#delete_row').submit(function (event) {
            var confirmed = confirm('Are you sure you want to delete this Brand? ');
            if (confirmed !== true) {
                event.preventDefault();
            }
        });
    </script>
@endsection