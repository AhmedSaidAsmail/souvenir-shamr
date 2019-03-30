<div class="filter-item-wrapper" tabindex="{{$index}}">
    <input type="hidden" name="product[filters][{{$filter->id}}][item][{{$index}}][filter_id]" value="{{$filter->id}}">
    <div class="row">
        <div class="col-md-10">
            <select name="product[filters][{{$filter->id}}][item][{{$index}}][filter_item_id]" class="form-control">
                <option value="">Select filter item</option>
                @foreach($filter->items as $item)
                    <option value="{{$item->id}}">{{$item->en_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-warning btn-block">Add Image</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <input type="file"
                   name="product[filters][1][item][1][gallery][]"
                   class="form-control">
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-danger btn-block">remove image</a>
        </div>
    </div>
</div>