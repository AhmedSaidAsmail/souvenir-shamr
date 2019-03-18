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
                <a class="nav-link">Index</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card data-table-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>All Products Filters</h2>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('admin.sections.create')}}" class="btn btn-primary addable">
                                <i class="fas fa-forward"></i> Add new section
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-customized" id="dataTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Section</th>
                            <th>Sort order</th>
                            <th>Publish date</th>
                            <th>Status</th>
                            <th>Home</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{$section->id}}</td>
                                <td>{{$section->en_name}}</td>
                                <td>{{$section->sort_order}}</td>
                                <td class="numbers">{{$section->created_at}}</td>
                                <td class="status">
                                    @if($section->status)
                                        <button class="btn btn-success">Confirmed</button>
                                    @else
                                        <button class="btn btn-warning">Pending</button>
                                    @endif
                                </td>
                                <td class="status">
                                    @if($section->home)
                                        <button class="btn btn-success">Confirmed</button>
                                    @else
                                        <button class="btn btn-warning">Pending</button>
                                    @endif
                                </td>
                                <td class="actions">
                                    <a href="{{route('admin.sections.edit',['id'=>$section->id])}}" class="editable">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <form action="{{route('admin.sections.destroy',['id'=>$section->id])}}" method="post"
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
            var confirmed = confirm('Are you sure you want to delete this Section? ');
            if (confirmed !== true) {
                event.preventDefault();
            }
        });
    </script>
@endsection