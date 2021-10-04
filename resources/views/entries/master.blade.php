<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/app.css')}}">
    <script src="{{ URL::asset('js/app.js')}}"></script>



</head>
<body>
<header>
    <div style="padding-top: 10px"></div>
</header>
<main>
    @yield('main')
</main>
<footer>
    @yield('footer')
    <form action="{{route('home')}}">
        <button type="submit" class="btn btn-primary" style="position: fixed;  bottom: 20px;  left: 20px;" >
            <i class="bi bi-house-fill"></i>
        </button>
    </form>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
</body>
</html>
