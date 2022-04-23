<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <h1>Step {{$info["step"]}} was created</h1>
        <h2>{{$info["name"]}}</h2>
        <p>{{$info["description"]}}</p>
    </body>
</html>
