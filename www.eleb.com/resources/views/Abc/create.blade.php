<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <body>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <form action="{{route('Abcs.index')}}">
            <input type="text" name="title">
            <input type="text" name="content">
        </form>

    </body>
</html>
