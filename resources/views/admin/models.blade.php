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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @yield('style')
        .fa-stack-2x {
            color: lightgray;
        }

        .button-delete-background {
            color: red;
        }

        .sidebar {
            width: 10%;
            height: inherit;
            float: left;
        }

        .main-content {
            width: 90%;
            float: left;
        }
        
        .main-content::after {
            display: table;
            content: "";
            clear: both;
        }


    </style>
</head>
<body style="height: 100%">

<aside class="sidebar">
    <div class="sidebar_element">
        <div class="dropdown">Происшествия
            <a class="dropdown-item nav-link" href="{{ route('admin.reports.index') }}">Все</a>
            <a class="dropdown-item nav-link" href="{{ route('admin.reports.create') }}">Создать</a>
        </div>
        <hr class="dropdown-divider">

        <div class="dropdown">Пользователи
            <a class="dropdown-item nav-link" href="{{ route('admin.users.index') }}">Все</a>
            <a class="dropdown-item nav-link" href="{{ route('admin.users.create') }}">Создать</a>
        </div>
        <hr class="dropdown-divider">

        <div class="dropdown">Категории
            <a class="dropdown-item nav-link" href="{{ route('admin.categories.index') }}">Все</a>
            <a class="dropdown-item nav-link" href="{{ route('admin.categories.create') }}">Создать</a>
        </div>
        <hr class="dropdown-divider">

        <div class="dropdown">Теги
            <a class="dropdown-item nav-link" href="{{ route('admin.tags.index') }}">Все</a>
            <a class="dropdown-item nav-link" href="{{ route('admin.tags.create') }}">Создать</a>
        </div>
        <hr class="dropdown-divider">


    </div>
</aside>

<main class="main-content">
    @yield('content')
</main>


<div class="block-saver hide" style="display: none;">
    @stack('hidden')
</div>

<script>
    var ajax_image_upload_url = '{{ route('admin.upload-image') }}';
    console.log(ajax_image_upload_url);
</script>

@section('scripts')
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/be.js"></script>
@show
</body>
</html>