@php
    $theme = Session::get("theme", "light");
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{$theme}}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")｜競賽紀錄網</title>
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
    <div class="position-fixed bottom-0 end-0 mb-3 me-3">
        <form action="{{route("api.set_theme")}}" method="post" id="themeform">
            @csrf
            <select id="theme" name="theme" class="form-select shadow-lg text-bg-primary fw-bold">
                <option value="light" @selected($theme == "light")>亮色</option>
                <option value="dark" @selected($theme == "dark")>暗色</option>
            </select>
        </form>
    </div>
    <script>
        $(() => {
            $("#theme").change(() => {
                $("#themeform").submit();
            })
        })
    </script>
    <div class="container">
        @yield('content')
    </div>
    @yield('footer')
</body>

</html>