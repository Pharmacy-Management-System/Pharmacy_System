<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .container{
            padding: 50px;
        }
        form{
            display: inline-block;
            margin-right: 10px
        }
        a{
            text-decoration: none;
        }
        .btn-success,.btn-danger{
            border-style: none;
            border-radius: 7px;
            padding: 10px 30px;
            color: white;
            margin-bottom: 10px;

        }
        .btn-success:hover{
            background-color: #00bc8d91;
        }
        .btn-success{
            background-color: #00bc8c;
        }
        .btn-danger{
            background-color: #e74c3c;
        }
        .btn-danger:hover{
            background-color: #e74d3c92;
        }
        .btn-container{
            text-align: center;
            width: 50%;
            margin: 50px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello {{$notifiable->name}}!</h1>
        <p>Your order is ready and waiting for your confirmation!!</p>
        <h4>Order Details : </h4>
        <ul>
            <li><strong>Order ID : </strong>{{$order->id}}</li>
            <li><strong>Delivery Address : </strong>{{$order->address->area->name}}</li>
            <li><strong>Pharmacy name : </strong>{{$order->pharmacy->pharmacy_name}}</li>
            @foreach ($order->medicines as $order_medicine)
                <li><strong>Ordered medicine : </strong>{{$order_medicine->name}}</li>
            @endforeach
            <li><strong>Order Status : </strong>{{$order->status}}</li>
            <li><strong>Total Price : </strong>{{$order->price}}</li>
        </ul>
        <div class="btn-container">
            <a href="{{route('stripe.get',$order->id)}}" type="submit" class="btn btn-success" disabled>Confirm Order</a>
            <a href="{{route("orders.updatestatus",$order->id)}}" type="submit" class="btn btn-danger" disabled>Cancel Order</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
