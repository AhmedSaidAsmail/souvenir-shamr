@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Customers</a>
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
                            <h2>Customer: {{$customer->name}}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="fields-section">
                        <div class="row">
                            <div class="col-md-2"><span class="field-name">Name</span></div>
                            <div class="col-md-4">{{$customer->name}}</div>
                            <div class="col-md-2"><span class="field-name">Email</span></div>
                            <div class="col-md-4">{{$customer->email}}</div>
                        </div>
                        @if($customer->details)
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Phone</span></div>
                                <div class="col-md-4">{{$customer->details->phone}}</div>
                                <div class="col-md-2"><span class="field-name">Address</span></div>
                                <div class="col-md-4">{{$customer->details->address}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Street</span></div>
                                <div class="col-md-4">{{$customer->details->street}}</div>
                                <div class="col-md-2"><span class="field-name">City</span></div>
                                <div class="col-md-4">{{$customer->details->city}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><span class="field-name">Country</span></div>
                                <div class="col-md-4">{{$customer->details->country}}</div>
                                <div class="col-md-2"><span class="field-name">Created At</span></div>
                                <div class="col-md-4">{{$customer->created_at}}</div>
                            </div>
                            @if($customer->details->hotel)
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Hotel</span></div>
                                    <div class="col-md-4">{{$customer->details->hotel->hotel}}</div>
                                    <div class="col-md-2"><span class="field-name">Room NO</span></div>
                                    <div class="col-md-4">{{$customer->details->room_no}}</div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="fields-section">
                        <h2>Credit Cards</h2>
                        @foreach($customer->creditCards as $creditCard)
                            <div class="credit">
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Name</span></div>
                                    <div class="col-md-4">{{$creditCard->name}}</div>
                                    <div class="col-md-2"><span class="field-name">Number</span></div>
                                    <div class="col-md-4">{{$creditCard->cc_no}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"><span class="field-name">Expire Date</span></div>
                                    <div class="col-md-4">{{$creditCard->cc_expire_month}}
                                        / {{$creditCard->cc_expire_year}}</div>
                                    <div class="col-md-2"><span class="field-name">CVV</span></div>
                                    <div class="col-md-4">{{$creditCard->cvv}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="fields-section">
                        <h2>Purchasing</h2>
                        @foreach($customer->reservations as $reservation)
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
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection