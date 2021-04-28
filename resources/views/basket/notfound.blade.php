@extends('layouts.basic')

@section('title', 'Not found')

@section('body')
<h1>Not found</h1>

<div class="alert alert-danger">
This product does not exist or has been removed.
</div>

<a href="{{ route('home') }}" class="btn btn-primary btn-lg d-block">
Back to product list
</a>
@endsection
