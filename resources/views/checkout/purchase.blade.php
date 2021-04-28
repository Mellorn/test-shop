@extends('layouts.basic')

@section('title', 'Confirmation of an order')

@section('body')
<h1>Confirmation of an order</h1>

<p>Total products: <span class="badge bg-info">{{ $products->count() }}</span></p>
<p>Total price: <span class="badge bg-info">{{ money_value_format($products->sum('price')) }}</span> &#8364;</p>

<p class="lead">To place an order, fill out the form below.</p>

<form role="form" action="{{ route('checkout.verify_purchase') }}" method="post">
@csrf

<fieldset>
<legend>Client data</legend>

<div class="mb-3 row">
<label class="col-3 col-form-label" for="client-name">Your name:</label>

<div class="col">
<input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client-name" name="client_name" autofocus required maxlength="100" value="{!! old('client_name') !!}">
@error('client_name')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>

<div class="mb-3 row">
<label class="col-3 col-form-label" for="client-address">Address:</label>

<div class="col">
<input type="text" class="form-control @error('client_address') is-invalid @enderror" id="client-address" name="client_address" required maxlength="300" value="{!! old('client_address') !!}">
@error('client_address')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>

<fieldset class="mb-3 row">
<legend class="col-3 col-form-label">Shipping option:</legend>

<div class="col">
<div class="form-check form-check-inline">
<input type="radio" class="form-check-input" id="shipping-option-standard" name="shipping_option" value="standard" checked>
<label class="form-check-label" for="shipping-option-standard">standard (free)</label>
</div>
<div class="form-check form-check-inline">
<input type="radio" class="form-check-input" id="shipping-option-express" name="shipping_option" value="express">
<label class="form-check-label" for="shipping-option-express">express (+ 10 &#8364;)</label>
</div>
</div>
</fieldset>
</fieldset>

<hr>

<fieldset>
<legend>Payment data</legend>

<div class="mb-3 row">
<label class="col-3 col-form-label" for="credit-card-number">Credit card number:</label>

<div class="col">
<input type="text" class="form-control @error('credit_card_number') is-invalid @enderror" id="credit-card-number" name="credit_card_number" required maxlength="19" value="{!! old('credit_card_number') !!}">
@error('credit_card_number')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>

<fieldset class="mb-3 row">
<legend class="col-3 col-form-label">Card expiry date:</legend>

<div class="col">
<div class="input-group">
<label class="input-group-text" for="ccredit-card-expiry-year">year</label>

<input type="text" class="form-control @error('credit_card_expiry.year') is-invalid @enderror" id="credit-card-expiry-year" name="credit_card_expiry[year]" required maxlength="4" value="{!! old('credit_card_expiry.year') !!}" placeholder="4 digits">
@error('credit_card_expiry.year')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>

<div class="col">
<div class="input-group">
<label class="input-group-text" for="ccredit-card-expiry-month">month</label>

<input type="text" class="form-control @error('credit_card_expiry.month') is-invalid @enderror" id="credit-card-expiry-month" name="credit_card_expiry[month]" required maxlength="2" value="{!! old('credit_card_expiry.month') !!}" placeholder="2 digits">
@error('credit_card_expiry.month')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>
</fieldset>

<div class="mb-3 row">
<label class="col-3 col-form-label" for="credit-card-cv">CVC/CVV:</label>

<div class="col">
<input type="password" class="form-control @error('credit_card_cv') is-invalid @enderror" id="credit-card-cv" name="credit_card_cv" required maxlength="4" value="{!! old('credit_card_cv') !!}">
@error('credit_card_cv')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>
</fieldset>

<div class="mb-3 row">
<div class="col offset-3">
<button type="submit" class="btn btn-success">Submit</button>
</div>
</div>
</form>
@endsection
