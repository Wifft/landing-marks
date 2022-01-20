<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Landing marks</title>
        @include('partials.site.styles')
    </head>
    <body class="bg-gray-900">
        <header class="text-center">
            <h1 class="text-white text-lg">{{ $map->title }}</h1>
        </header>

        <main>
            @yield('content')
        </main>

        @include('partials.site.scripts')
    </body>
</html>
