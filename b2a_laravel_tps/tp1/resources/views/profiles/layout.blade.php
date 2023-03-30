<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>

    <link href="/css/app.css" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body>
    <div class="container">
        <header><h1>@yield('title', 'Bonsoir Administrateur')</h1></header>

        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success">
                {{ \Illuminate\Support\Facades\Session::get('success') }}
            </div>
        @endif

        <nav>
            <ul>

            </ul>
        </nav>
        @yield('content')
    </div>
</body>
</html>
