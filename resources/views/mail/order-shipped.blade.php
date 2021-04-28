<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1>There is a new order</h1>

<h2>Order details</h2>
<p>Order ID: {{ $order->id }}</p>
<p>Total products: {{ $order->total_product_value }}</p>
<p>Total price: {{ money_value_format($order->total_shipping_value) }} &#8364;</p>
<p>Shipping option: {{ $shippingOption }}</p>

<h2>Items included in the order</h2>
<table class="table">
<thead>
<tr>
<th>Name</th><th>Brand</th><th>Price</th>
</tr>
</thead>
<tbody>
@foreach ($products as $product)
<tr>
<td>{{ $product->name }}</td>
<td>{{ $product->brand->name }}</td>
<td>{{ $product->formatted_price }} &#8364;</td>
</tr>
@endforeach
</tbody>
</table>
</body>
</html>
