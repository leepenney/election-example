<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>General Election Poll</title>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-primary">
            <a href="/" class="nav-link text-white">Home</a>
            <a href="/results" class="nav-link text-white">Results</a>
        </nav>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
