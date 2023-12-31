<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AnonVerse</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .active {
            border: 1px solid black;
            border-radius: 15px;
            color: white;
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('logo.png') }}" width="50px" height="50px" style="border-radius: 50%;"
                        alt="">
                    <b>AnonVerse</b>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 active">Home</a></li>
                <li><a href="/feed" class="nav-link px-2">Feed</a></li>
                <li><a href="/komunitas" class="nav-link px-2">Komunitas</a></li>
                <li><a href="/cari_avatar" class="nav-link px-2">Avatar</a></li>
            </ul>

            <div class="col-md-3 text-end">
                @if (Auth::check())
                    <div class="btn-group">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="48" height="48"
                            class="rounded-circle" />
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/akun-anda">Akun Anda</a></li>
                          <li><a class="dropdown-item" href="/chatify">Chatify</a></li>
                          <li><a class="dropdown-item" href="/logout">Keluar</a></li>
                        </ul>
                      </div>

                @else
                    <a href="/login">
                        <button type="button" class="btn btn-outline-primary me-2">
                            Login
                        </button>
                    </a>
                    <a href="/register">
                        <button type="button" class="btn btn-primary">Register</button>
                    </a>
                @endif
            </div>
        </header>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
    @endif
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
