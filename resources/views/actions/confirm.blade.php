<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Cancellation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container w-50 p-5 border shadow-lg rounded-5" style="margin-top: 150px;">
        <h3 class="mb-5">Hello {{ $order->user->name }}!</h3>
        @if ($state == 'Canceled')
            <p><Strong>You can't confirm your order. Your order is already Cancelled.</Strong></p>
            <p class="mt-5">Thank You for using our website..</p>
        @elseif ($state == 'Confirmed')
            <p><Strong>Your order is already confirmed..</Strong></p>
            <p class="mt-5">Thank You for using our website..</p>
        @elseif ($state == 'Confirmednow')
            <p><Strong>Your order is now Confirmed.</Strong></p>
            <p class="mt-5">Thank You for using our website..</p>
        @elseif ($state == 'Delivered')
            <p><Strong>Your order is already Delivered.</Strong></p>
            <p class="mt-5">Thank You for using our website..</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
