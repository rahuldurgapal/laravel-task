<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a href="{{route('logout')}}" class="btn btn-primary">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Hello, {{ Auth::user()->name }}!</h1>
            <p class="lead">Welcome to your dashboard.</p>
            <hr class="my-4">
        </div>
    </div>
   
</body>
</html>