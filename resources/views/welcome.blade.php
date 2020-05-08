<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gochri</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- Fonts -->
        
    </head>
    <body>
            

            <nav class="navbar navbar-expand navbar-light bg-light">
                @if (Route::has('login'))
                    <div class="nav navbar-nav ml-auto">
                        @auth
                            @if(Auth::user()->role == 'admin')
                                <a class="nav-item nav-link" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                            @endif
                            @if(Auth::user()->role == 'customer')
                                <a class="nav-item nav-link" href="{{ url('/customer/dashboard') }}">Dashboard</a>
                            @endif
                            @if(Auth::user()->role == 'supplier')
                                <a class="nav-item nav-link" href="{{ url('/supplier/dashboard') }}">Dashboard</a>
                            @endif
                        @else
                            <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
            
    </body>
</html>
