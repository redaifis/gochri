<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- MINIFIED -->
    {!! SEO::generate() !!}

    <!-- Scripts & Styles -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

    {{-- <title>Gochri</title> --}}

</head>
<body>

    <div id="app">
        @yield('content')
    </div>

    @if(Auth::check())
        <script>
            window.user = {!! Auth::user() !!}
        </script>
    @endif

    @if(Auth::check() && Auth::user()->wishlist()->exists())
        <script>
            window.wishlist = {!! Auth::user()->wishlist()->first()->products()->get()->pluck('id') !!}
        </script>
    @endif

    @yield('scripts')

</body>
</html>
