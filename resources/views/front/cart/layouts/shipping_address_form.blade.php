@if($add=auth()->guard('customer')->user()->details)
    <div class="shipping-address-wrapper">
        <h2>{{translate('SHIPPING ADDRESS')}}</h2>
        <a href="#" class="edit-address">{{translate('Edit Delivery Location')}}</a>
        <div class="shipping-address">
            <span>{{translate('Delivery address')}}</span>
            <p>{{auth()->guard('customer')->user()->name}}, {{$add->location()->address}}</p>
            <p>{{$add->phone}}</p>
            @if($add->hotel()->exists())
                {{$add->hotel->hotel}}, Room No: {{$add->room_no}}
            @endif
            <div class="update-location-form">
                <form method="post"
                      action="{{route('cart.checkout.shippingAddress.update',['lang'=>$lang,'address_id'=>$add->id])}}"
                      id="location_form">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="customer_id"
                           value="{{auth()->guard('customer')->user()->id}}">
                    <input type="hidden" name="city" value="{{$add->city}}">
                    <input type="hidden" name="country" value="{{$add->country}}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{translate('phone')}}</label>
                                <input class="form-control" name="phone" value="{{$add->phone}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Hotel</label>
                                <select name="hotel_id" class="form-control">
                                    <option value="">{{translate('Select a hotel')}}</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{$hotel->id}}"
                                                {!! $add->hotel_id==$hotel->id?"selected":null !!}>
                                            {{$hotel->hotel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{translate('Room No')}}</label>
                                <input class="form-control" name="room_no" value="{{$add->room_no}}"
                                       disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" value="{{$add->address}}"
                                       placeholder="Your location address">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
                </form>
            </div>
        </div>
    </div>
@else
    <a class="add-location" href="#">
        <i class="fas fa-plus-circle"></i> {{translate('Add shipping address')}}
    </a>
    <div class="location-form">
        <form method="post" action="{{route('cart.checkout.shippingAddress.add',['lang'=>$lang])}}"
              id="location_form">
            {{csrf_field()}}
            <input type="hidden" name="customer_id"
                   value="{{auth()->guard('customer')->user()->id}}">
            <input type="hidden" name="city" value="sharm el sheikh">
            <input type="hidden" name="country" value="Egypt">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>{{translate('phone')}}</label>
                        <input class="form-control" name="phone">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Hotel</label>
                        <select name="hotel_id" class="form-control">
                            <option value="">{{translate('Select a hotel')}}</option>
                            @foreach($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->hotel}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>{{translate('Room No')}}</label>
                        <input class="form-control" name="room_no" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" name="address"
                               placeholder="Your location address">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">{{translate('SAVE THIS LOCATION')}}</button>
        </form>
    </div>
@endif