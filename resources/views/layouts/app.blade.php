<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ config('app.name') }} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('head')

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90460921-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-90460921-2');
        </script>
    </head>
    <body class="h-screen">
        <div class="h-full flex flex-col" id="app">
            <main class="px-4 flex-grow overflow-y-auto">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <livewire:scripts>
    </body>
</html>
