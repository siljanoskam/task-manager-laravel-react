<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel React application</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<h2 class="text-center pt-5"> Task manager </h2>
<div id="root"></div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
