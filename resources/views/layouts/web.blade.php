<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>首頁｜競賽紀錄網</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @stack("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        *::-webkit-scrollbar {
            width: .5rem;
        }

        *::-webkit-scrollbar-thumb {
            border: #e9ecef solid .1rem;
            border-radius: .8rem;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #4285F4;
        }

        /* *::-webkit-scrollbar:horizontal {
        height: .5rem;
        } */
        *::-webkit-scrollbar:horizontal {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        /* * {
            -ms-overflow-style: none;
            scrollbar-width: none;
        } */
    </style>
    @stack("scripts")
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <header
        class="d-flex shadow-sm flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0 text-center">
            <a href="{{route('home')}}" class="d-inline-flex link-body-emphasis text-decoration-none">
                <span class="wt064 fs-1" style="color:#C9AD8B">競賽紀錄</span>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 wt064 fs-4 justify-content-center mb-md-0 text-center">
            <li>
                <a href="{{route('home')}}"
                    class="nav-link px-2 @if ($request_url == route('home')) link-secondary @endif">首頁</a>
            </li>
            <li>
                <a href="{{route('announcements.list')}}"
                    class="nav-link px-2 @if ($request_url == route('announcements.list')) link-secondary @endif">公告</a>
            </li>
            <li>
                <a href="{{route('athletes.list')}}"
                    class="nav-link px-2 @if ($request_url == route('athletes.list')) link-secondary @endif">歷屆選手</a>
            </li>
            <li>
                <a href="{{route('collections.list')}}"
                    class="nav-link px-2 @if ($request_url == route('collections.list')) link-secondary @endif">練習作品</a>
            </li>
        </ul>

        <div class="col-md-3 text-center">
            <a href="{{route('login')}}" class="btn fs-3 border-0">
                <i class="bi bi-box-arrow-in-right me-2"></i><span class="wt064">登入</span>
            </a>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
    @yield('footer')
</body>

</html>