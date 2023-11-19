<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eCom </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h3 class="text-primary">Order Details</h3> 
    <hr>
    <table class="table table-striped table-bordered">
            <tr>
                <th>Purchaser:</th>
                <td> {{$order->user->name}} </td>
            </tr>
            <tr>
                <th>Product:</th>
                <td> {{$order->product->name}} </td>
            </tr>
            <tr>
                <th>Price:</th>
                <td> ${{$order->price}} </td>
            </tr>
            <tr>
                <th>Quantity:</th>
                <td> {{$order->quantity}} </td>
            </tr>
            <tr>
                <th>Total:</th>
                <td> ${{$order->total}} </td>
            </tr>
            <tr>
                <th>Payment Status:</th>
                <td> {{$order->payment_status}} </td>
            </tr>
            <tr>
                <th>Delivery Status:</th>
                <td> {{$order->delivery_status}} </td>
            </tr>
    </table> <hr>

    <p>
        Thank You so much for Your Purchase, Dear Customer.
    </p>
</body>
</html>