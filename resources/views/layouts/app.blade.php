<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Landing marks</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @include('partials.site.styles')
    </head>
    <body class="bg-gray-900">
        <main class="grid grid-cols-[20%_80%] mx-auto justify-items-center">
            @yield('content')
        </main>

        @include('partials.site.scripts')
    </body>
</html>
