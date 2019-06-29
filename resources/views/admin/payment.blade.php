@extends('admin.layouts.master')
@section('content')
    <div class="col-md-10 offset-md-2 main-interface">
        <ul class="nav directory">
            <li class="nav-item">
                <a class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Payment</a>
            </li>
        </ul>
        @include('admin.layouts.notification')
        <div class="payment-section">
            <h2>Paypal Setting</h2>
            @if($paypal)
                <form method="post" action="{{route('admin.paypal.update',['id'=>$paypal->id])}}"
                      id="paypal_destroy_form">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                </form>
                <form method="post" action="{{route('admin.paypal.update',['id'=>$paypal->id])}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Client ID</label>
                                <input class="form-control" name="client_id" value="{{$paypal->client_id}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secret</label>
                                <input class="form-control" name="secret" value="{{$paypal->secret}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" name="description" value="{{$paypal->description}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SandBox</label>
                                <select class="form-control" name="sandbox">
                                    <option value="1">true</option>
                                    <option value="0" {{!$paypal->sandbox?"selected":null}}>false</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fab fa-paypal"></i> Save Paypal Setting</button>
                    <button class="btn btn-danger" form="paypal_destroy_form"><i class="fas fa-trash-alt"></i> Delete
                        Setting
                    </button>
                </form>
            @else
                <form method="post" action="{{route('admin.paypal.store')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Client ID</label>
                                <input class="form-control" name="client_id" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secret</label>
                                <input class="form-control" name="secret" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" name="description" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SandBox</label>
                                <select class="form-control" name="sandbox">
                                    <option value="1">true</option>
                                    <option value="0">false</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fab fa-paypal"></i> Save Paypal Setting</button>
                </form>
            @endif
        </div>
        <div class="payment-section">
            <h2>Credit Gateway</h2>
            @if($paymentGateway)
                <form method="post" action="{{route('admin.credit.update',['id'=>$paymentGateway->id])}}"
                      id="credit_destroy_form">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                </form>
                <form method="post" action="{{route('admin.credit.update',['id'=>$paymentGateway->id])}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Partner ID</label>
                                <input class="form-control" name="partner_id" value="{{$paymentGateway->partner_id}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Public Key</label>
                                <input class="form-control" name="public_key" value="{{$paymentGateway->public_key}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Private Key</label>
                                <input class="form-control" name="private_key" value="{{$paymentGateway->private_key}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSL</label>
                                <select class="form-control" name="ssl">
                                    <option value="1">true</option>
                                    <option value="0" {{!$paymentGateway->ssl?'selected':null}}>false</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SandBox</label>
                                <select class="form-control" name="sandbox">
                                    <option value="1">true</option>
                                    <option value="0" {{!$paymentGateway->sandbox?'selected':null}}>false</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-credit-card"></i> Save Payment Gateway Setting</button>
                    <button class="btn btn-danger" form="credit_destroy_form"><i class="fas fa-trash-alt"></i> Delete
                        Setting
                    </button>
                </form>
            @else
                <form method="post" action="{{route('admin.credit.store')}}">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Partner ID</label>
                                <input class="form-control" name="partner_id" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Public Key</label>
                                <input class="form-control" name="public_key" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Private Key</label>
                                <input class="form-control" name="private_key" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSL</label>
                                <select class="form-control" name="ssl">
                                    <option value="1">true</option>
                                    <option value="0">false</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SandBox</label>
                                <select class="form-control" name="sandbox">
                                    <option value="1">true</option>
                                    <option value="0">false</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-credit-card"></i> Save Payment Gateway Setting</button>
                </form>
            @endif
        </div>
    </div>
@endsection