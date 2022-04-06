<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <p>Hi {{$order->user()->fname}}</p>
    <p>Your order has been placed successfully </p>

















    {{-- <table style="width: 600px; text-align:right" >
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->$orderItems as $item)
        <tr>
            <td> <img src="{{image}}/{{$product->image}}" alt="Order Image" width="100"> </td>
            <td>{{$}}</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>


    </table> --}}

</body>
</html>
