<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- Styles / Scripts -->
       
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes data-stream {
            0% {
            transform: translateY(-100%);
            }
            100% {
            transform: translateY(100%);
            }
        }

        @keyframes hash-complete {
            0% {
            transform: scale(1);
            opacity: 1;
            }
            50% {
            transform: scale(1.5);
            opacity: 0.5;
            }
            100% {
            transform: scale(0);
            opacity: 0;
            }
        }

        @keyframes mining-pulse {
            0%, 100% {
            opacity: 0.5;
            transform: scale(0.95);
            }
            50% {
            opacity: 1;
            transform: scale(1.05);
            }
        }
    </style>
       
            

    </head>

    <body>
        {{ $slot }}
    </body>

</html>