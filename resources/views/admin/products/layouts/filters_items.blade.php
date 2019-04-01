<div class="card" tabindex="{{$filter->id}}">
    <div class="card-header">
        <a href="#" class="btn btn-danger remove-filter">
            <i class="fas fa-times"></i>
        </a>
        {{$filter->en_name}}
        <input type="hidden" name="product[filters][{{$filter->id}}][filter_id]" value="{{$filter->id}}">
    </div>
    <div class="card-body">
        <select name="product[filter_items][{{$filter->id}}][]"
                class="form-control multi-choice" multiple="multiple" style="width: 100%">
            <option value="">Select filter item</option>
            @foreach($filter->items as $item)
                <option value="{{$item->id}}">{{$item->en_name}}</option>
            @endforeach
        </select>
    </div>
</div>