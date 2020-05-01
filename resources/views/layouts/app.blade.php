<html>
    <head>
        <title>{{ config('app.name') }} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @yield('head')

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles>
    </head>
    <body>
        <div class="h-full flex flex-col" id="app">
            <div class="flex-grow">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <livewire:scripts>
    </body>
</html>
