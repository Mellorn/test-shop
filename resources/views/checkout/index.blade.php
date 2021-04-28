@extends('layouts.basic')

@section('title', 'Your basket')

@section('body')
<h1>Your basket</h1>

@if ($products !== null)
<p>Total products: <span class="badge bg-info">{{ $products->count() }}</span></p>
<p>Total price: <span class="badge bg-info">{{ money_value_format($products->sum('price')) }}</span> &#8364;</p>

<div class="btn-group">
<a href="{{ route('home') }}" class="btn btn-link">
Continue shopping
</a>
<a href="{{ route('checkout.purchase') }}" class="btn btn-link">
Proceed to Checkout
</a>
</div>

<h2>Items in the basket</h2>
<table class="table">
<thead>
<tr>
<th>Name</th><th>Brand</th><th>Price</th><th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($products as $product)
<tr>
<td>{{ $product->name }}</td>
<td>{{ $product->brand->name }}</td>
<td>{{ $product->formatted_price }} &#8364;</td>
<td>
<form action="{{ route('basket.remove_item', ['id' => $product->id]) }}" method="post">
@csrf
@method('delete')
<button type="submit" class="btn btn-danger">Remove</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

<div class="btn-group">
<a href="{{ route('home') }}" class="btn btn-link">
Continue shopping
</a>
<a href="{{ route('checkout.purchase') }}" class="btn btn-link">
Proceed to Checkout
</a>
</div>

@else
<div class="alert alert-warning">
Your basket is currently empty.
</div>

<a href="{{ route('home') }}" class="btn btn-primary btn-lg d-block">
Go to product selection
</a>
@endif
@endsection
