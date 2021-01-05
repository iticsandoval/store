<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conekta Oxxo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- styles itic -->
    <link rel="stylesheet" href="{{asset("/css/app.css")}}">


    <style>
        body
        {
            background-image: url({{ asset("/img/backgroung.png") }}) !important;
            background-size: cover !important;

        }
    </style>

</head>
<body>

<div class="container offset-md-2 col-md-8">
    <header class="main-header">
        <h4>
            <span class="icon-title">
                <i class="fas fa-cart-plus"></i>
            </span>
            Pago con Conekta | OXXO PAY
        </h4>
    </header>

    <br>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>ID Método de Pago</th>
            <th>Fecha</th>
            <th>Actualización</th>
            <th>Método Pago</th>
            <th>No. Items</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)

                <tr>
                    <td>{{$order->OrderID}}</td>
                    <td>{{$order->OrderPaymentMethodID}}</td>
                    <td>{{$order->OrderDate}}</td>
                    <td>{{$order->OrderUpdateDate}}</td>
                    <td>{{$order->OrderPaymentMethod}}</td>
                    <td>{{$order->OrderTotalItems}}</td>
                    <td>$ {{$order->OrderTotal}} {{$order->OrderCurrency}}</td>
                    <td>
                        @if($order->OrderStatus == "pending_payment" || $order->OrderStatus == null)
                            <span class="badge badge-warning">{{$order->OrderStatus}}</span>
                        @elseif($order->OrderStatus == "paid")
                            <span class="badge badge-success col-md-12">{{$order->OrderStatus}}</span>
                        @endif

                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <a href="checkout"> Ir a compra</a>
    </div>


</div>





</body>
</html>


<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- js itic -->
<script src="{{asset("/js/checkout.js")}}"></script>
