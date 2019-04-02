@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Gallery</a>
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
                            <h2>Add {{$product->en_name}} gallery</h2>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success" form="basic_form"><i class="fas fa-save"></i></button>
                            <a class="btn btn-primary" href="{{URL::previous()}}"><i class="fas fa-reply-all"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.gallery.store',['product'=>$product->id])}}"
                          enctype="multipart/form-data" id="basic_form">
                        {{csrf_field()}}
                        <div class="gallery-wrapper">
                            {{-- product filter list --}}
                            <datalist id="filters">
                                <option value="">Select filter</option>
                                @foreach($product->productFilters as $productFilter)
                                    <option value="{{$productFilter->id}}">{{$productFilter->en_name}}</option>
                                @endforeach
                            </datalist>
                            {{-- product filter list --}}
                            <div class="current-images row">
                                @foreach($product->gallery as $image)
                                    <div class="filter-inputs col-md-2" tabindex="{{$image->id}}">
                                        <div class="current-image">
                                            <img src="{{asset('images/products/thumb/'.$image->image)}}">
                                        </div>
                                        <div class="current-image-ref row">
                                            <input type="hidden" value="{{$image->id}}"
                                                   name="gallery[{{$image->id}}][id]">
                                            <input type="hidden" value="{{$image->image}}"
                                                   name="gallery[{{$image->id}}][image]">
                                            <input type="hidden" value="{{$image->filter_item_id}}"
                                                   name="gallery[{{$image->id}}][filter_item_id]">
                                            <div class="col">
                                                <input type="number" class="form-control" value="{{$image->sort_order}}"
                                                       name="gallery[{{$image->id}}][sort_order]" required>
                                            </div>
                                            @if(!is_null($image->filter_item_id))
                                                <div class="col filter-name">
                                                    {{$image->filterItem->en_name}}
                                                </div>
                                            @endif
                                        </div>
                                        <a href="#" class="btn btn-danger btn-block remove-image">Remove image</a>
                                    </div>
                                @endforeach
                            </div>
                            <a href="#" class="btn btn-warning btn-block add-gallery">Add image to gallery</a>

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
@section('javascript')
    @parent
    <script>
        var filters = $("datalist#filters").html();
        $("a.add-gallery").click(function (event) {
            event.preventDefault();
            var index = galleryIndex();
            $(this).closest('.gallery-wrapper').append('<div class="row filter-inputs" tabindex="' + index + '">\n' +
                '                                    <div class="col-md-6">\n' +
                '                                        <input type="file" class="form-control" name="gallery[' + index + '][image]" required>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-3">\n' +
                '                                        <select  class="form-control" name="gallery[' + index + '][filter_item_id]">\n' +
                filters +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-2">\n' +
                '                                        <input type="number" min="0" value="0" class="form-control" name="gallery[' + index + '][sort_order]"\n' +
                '                                               placeholder="Sort order" required>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-1">\n' +
                '                                        <a href="#" class="btn btn-danger remove-gallery">\n' +
                '                                            <i class="fas fa-times"></i>\n' +
                '                                        </a>\n' +
                '                                    </div>\n' +
                '                                </div>');
            removeGallery();
        });

        function removeGallery() {
            $("a.remove-gallery").click(function (event) {
                event.preventDefault();
                $(this).closest('.filter-inputs').remove();
            });
        }

        function galleryIndex() {
            var index = 0;
            $(".filter-inputs").each(function () {
                if ($(this).attr('tabindex') > index) {
                    index = $(this).attr('tabindex');
                }
            });
            return parseInt(index) + 1;
        }
        $("a.remove-image").click(function (event) {
            event.preventDefault();
            var wrapper=$(this).closest('.filter-inputs');
            wrapper.remove();
        });
    </script>

@endsection