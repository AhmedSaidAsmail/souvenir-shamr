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
                <a class="nav-link">Index</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card data-table-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>All Localizations Words</h2>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('admin.localization.create')}}" class="btn btn-primary addable">
                                <i class="fas fa-forward"></i> Add new Translation
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-customized" id="dataTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Word</th>
                            <th>English</th>
                            <th>Arabic</th>
                            <th>Russian</th>
                            <th>Italian</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($localizations as $localization)
                            <tr>
                                <td>{{$localization->id}}</td>
                                <td>{{$localization->word}}</td>
                                <td>{{$localization->word_en}}</td>
                                <td>{{$localization->word_ar}}</td>
                                <td>{{$localization->word_ru}}</td>
                                <td>{{$localization->word_it}}</td>
                                <td class="actions">
                                    <a href="{{route('admin.localization.edit',['id'=>$localization->id])}}" class="editable">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <form action="{{route('admin.localization.destroy',['id'=>$localization->id])}}" method="post"
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