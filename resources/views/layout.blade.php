<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>@yield('judul')</title>

    <style>
        .center {
            padding: 70px 0 0 0;
            margin: auto;
            text-align: center;
        }
        .brand {
            font-weight: 700;
            margin-bottom: 20px;
        }
        .btn {
            margin: 0px 10px;
        }
    </style>

</head>
<body>
    
    <div class="container">            
        @yield('content')        
    </div>    
    
</body>
</html>