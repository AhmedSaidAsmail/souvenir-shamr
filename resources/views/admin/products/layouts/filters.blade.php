<option value="">Select filter</option>
@foreach($filters as $filter)
    <option value="{{$filter->id}}">{{$filter->en_name}}</option>
@endforeach