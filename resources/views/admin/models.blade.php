<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Панель администратора</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/public/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @yield('style')
        .fa-stack-2x {
            color: lightgray;
        }

        .button-delete-background {
            color: red;
        }
    </style>
</head>
<body>


<main>
    @yield('content')
</main>


<div class="block-saver hide" style="display: none;">
    @stack('hidden')
</div>
@section('scripts')
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/be.js"></script>
@show
</body>
</html>