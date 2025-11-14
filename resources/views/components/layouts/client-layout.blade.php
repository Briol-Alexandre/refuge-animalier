<!doctype html>
<html lang="{!! app()->getLocale() !!}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        @vite(['resources/js/scripts/slider.js'])
        <title>Document - {{config('app.name')}}</title>
    </head>
    <body class="font-poppins overflow-x-hidden">
        <h1 class="sr-only">Les pattes heureuses</h1>
        <x-nav/>
        <main class="mt-24">
            {{$slot}}
        </main>
    </body>
</html>
