<?php
$brands_list = [];
if (!is_null($category)) {
    $brands_list = array_column($category->brands->toArray(), 'id');
}
?>
@foreach($brands as $brand)
    <option value="{{$brand->id}}" {{in_array($brand->id,$brands_list)?"selected":null}}>{{$brand->en_name}}</option>
@endforeach