@extends('layouts.basic')

@section('title', 'Completed')

@section('body')
<h1>Completed</h1>

<h2>Order details</h2>
<p>Total products: <span class="badge bg-info">{{ $orderData['total_product_value'] }}</span></p>
<p>Total price: <span class="badge bg-info">{{ money_value_format($orderData['total_shipping_value']) }}</span> &#8364;</p>
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

<a href="{{ route('home') }}" class="btn btn-primary d-block">OK</a>
@endsection
