<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="author" content="Eugene Loboda">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ mix('assets/css/styles.css') }}" rel="stylesheet">
<title>@yield('title', '')</title>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
@yield('body', '')
</div>
</div>
</div>
</body>
</html>
