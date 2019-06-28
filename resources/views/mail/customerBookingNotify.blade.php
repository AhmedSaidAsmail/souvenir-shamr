<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato:300,400,700');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: #2c3e50;
        }

        .container {
            width: 100%;
            background-color: #e6e6e6;
            padding: 10px 0;
        }

        span {
            display: block;
        }

        .msg-container {
            width: 94%;
            margin: 10px auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #c8c6c6;

        }

        .logo-holder {
            display: block;
            padding-bottom: 10px;
            position: relative;
            margin-bottom: 15px;
        }

        .logo-holder:after {
            position: absolute;
            top: 100%;
            left: 0;
            height: 1px;
            width: 100%;
            background-color: #c8c6c6;
            content: '';
        }

        table {
            width: 90%;
            margin: 10px auto;
            text-align: center;
            /*border: 1px solid #c8c6c6;*/
        }

        table > thead > tr > th, table > tbody > tr > td {
            border-bottom: 1px solid #c8c6c6;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        h2 {
            font-style: italic;
            font-weight: 300;
            margin: 0;
            color: #e74c3c;
        }

        .customer-service {
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="msg-container">
    <span class="logo-holder">
        <img src="{{asset('images/logo.png')}}">
    </span>
        Dear {{$reservation->customer->name}}
        <p>Thanks for your recent purchase with {{request()->getHost()}}</p>
        <p>I am pleased to confirm receipt of your purchasing as follows:</p>
        <span class="details-header">YOUR PURCHASING DETAILS</span>
        <table>
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Price ({{strtoupper($reservation->currency)}})</th>
                <th>Quantity</th>
                <th>Total ({{strtoupper($reservation->currency)}})</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservation->items as $item)
                <tr>
                    <td>{{$item->product->en_name}}</td>
                    <td>{{sprintf('%.2f',$item->product->price)}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{sprintf('%.2f',$item->total)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <span>Total:{{translate('$')}}{{sprintf('%.2f',$reservation->total)}}</span>
        @if($reservation->payment_approval)
            <span>Transaction ID: {{$reservation->transaction_id}}</span>
            <span>Payment method: {{$reservation->payment_method}}</span>
        @endif
        <br>
        <span>You can make login using ( Email:{{$reservation->customer->email}})</span>
        <br><br>
        <h2>Best Regards</h2>
        <span class="customer-service">{{request()->getHost()}} Customer Service Team</span>
    </div>
</div>
</body>
</html>