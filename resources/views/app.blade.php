<!DOCTYPE html>
<html>
    <head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <title>Sudoku's</title>

    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="{{asset('js/sudoku.js')}}"></script>

    </body>
</html>