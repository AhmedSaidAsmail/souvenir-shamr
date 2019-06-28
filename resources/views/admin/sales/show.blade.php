@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Show</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <section class="content">
            <div class="card data-table-wrapper">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>Order No: {{$reservation->unique_id}}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="fields-section">
                        <h2>Order Details</h2>
                        <div class="reservation">
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Purchasing NO</span></div>
                                <div class="col-md-4">{{$reservation->unique_id}}</div>
                                <div class="col-md-2"><span class="field-name">Total</span></div>
                                <div class="col-md-4">{{sprintf('%.2f %s',$reservation->total,strtoupper($reservation->currency))}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Payment Method</span></div>
                                <div class="col-md-4">{{$reservation->payment_method}}</div>
                                <div class="col-md-2"><span class="field-name">Payment Approval</span></div>
                                <div class="col-md-4">{{$reservation->payment_approval?'Paid':'Not Paid'}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Transaction Id</span></div>
                                <div class="col-md-4">{{$reservation->transaction_id}}</div>
                                <div class="col-md-2">
                                    <a href="{{route('admin.reservations.show',['id'=>$reservation->id])}}">
                                        MoreDetails
                                    </a>
                                </div>
                            </div>
                        </div>
                        <h2>Customer Details</h2>
                        <div class="reservation">
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Name</span></div>
                                <div class="col-md-4">{{$reservation->customer->name}}</div>
                                <div class="col-md-2"><span class="field-name">Email</span></div>
                                <div class="col-md-4">{{$reservation->customer->email}}</div>
                            </div>
                            @if($reservation->customer->details)
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Phone</span></div>
                                    <div class="col-md-4">{{$reservation->customer->details->phone}}</div>
                                    <div class="col-md-2"><span class="field-name">Address</span></div>
                                    <div class="col-md-4">{{$reservation->customer->details->address}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Street</span></div>
                                    <div class="col-md-4">{{$reservation->customer->details->street}}</div>
                                    <div class="col-md-2"><span class="field-name">City</span></div>
                                    <div class="col-md-4">{{$reservation->customer->details->city}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Country</span></div>
                                    <div class="col-md-4">{{$reservation->customer->details->country}}</div>
                                    <div class="col-md-2"><span class="field-name">Created At</span></div>
                                    <div class="col-md-4">{{$reservation->customer->created_at}}</div>
                                </div>
                                @if($reservation->customer->details->hotel)
                                    <div class="row">
                                        <div class="col-md-2"><span class="field-name">Hotel</span></div>
                                        <div class="col-md-4">{{$reservation->customer->details->hotel->hotel}}</div>
                                        <div class="col-md-2"><span class="field-name">Room NO</span></div>
                                        <div class="col-md-4">{{$reservation->customer->details->room_no}}</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="fields-section">
                        <h2>Order Items</h2>
                        @foreach($reservation->items as $item)
                            <div class="reservation">
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Name</span></div>
                                    <div class="col-md-10">{{$item->product->en_name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Price</span></div>
                                    <div class="col-md-4">{{sprintf('%.2f %s',$item->total,strtoupper($reservation->currency))}}</div>
                                    <div class="col-md-2"><span class="field-name">Quantity</span></div>
                                    <div class="col-md-4">{{$item->quantity}}</div>
                                </div>
                                <ul>
                                    @foreach(unserialize($item->details) as $filter=>$value)
                                        <li><span class="field-name">{{$filter}}</span> : {{$value}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection