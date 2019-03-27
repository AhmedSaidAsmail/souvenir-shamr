<div class="form-group">
    <label>Brands</label>
    <select name="category[brands][]" class="form-control multi-choice"
            multiple="multiple" id="brands_val" style="width: 100%">
        @foreach($not_category_brands as $brand)
            <option value="{{$brand->id}}">{{$brand->en_name}}</option>
        @endforeach
    </select>
</div>
<ul class="nav costume-list">
    @foreach($category_brands as $brand)
        <li class="nav-item"><a class="btn btn-secondary">{{$brand->en_name}}</a></li>
    @endforeach
</ul>