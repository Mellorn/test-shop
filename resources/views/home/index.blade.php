@extends('layouts.basic')

@section('title', 'Products list')

@section('body')
<p class="lead">There are <span class="badge bg-info">{{ $basketItemsCount }}</span> products in your basket</p>

@if ($basketItemsCount > 0)
<a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg d-block">
Go to checkout
</a>
@endif

<h1>Products list</h1>

@if ($products->isNotEmpty())
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
<form action="{{ route('basket.add_item') }}" method="post">
@csrf
<input type="hidden" name="id" value="{{ $product->id }}">
<button type="submit" class="btn btn-success">Buy</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

@if ($products->hasPages())
{{ $products->links() }}
@endif

@else
<div class="alert alert-warning">
No products found.
</div>
@endif
@endsection
