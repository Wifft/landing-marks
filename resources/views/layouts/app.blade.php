<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Landing Marks</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        @include('partials.site.favicon')
        @include('partials.site.styles')
    </head>
    <body class="bg-gray-900">
        @yield('page')

        @include('partials.site.scripts')
    </body>
</html>
