<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AnonVerse</title>
    <link rel="shortcut icon" style="border-radius: 50%;" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
</head>

<body>
    <script src="{{ asset('iziToast-master/dist/js/iziToast.min.js') }}" type="text/javascript"></script>
    <script>
        @if ($errors->any())
            iziToast.error({
                title: 'Error',
                position: 'topCenter',
                message: '{{ $errors->first() }}',
            });
        @endif
        @if (session('success'))
            iziToast.success({
                title: 'Success',
                position: 'topCenter',
                message: "{{ session('success') }}"
            });
        @endif
    </script>
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
                <li><a href="/" style="color: black;"
                        class="nav-link px-2 {{ request()->is('/') ? 'active text-primary' : '' }}">Home</a></li>
                <li><a href="/feed" style="color: black;"
                        class="nav-link px-2 {{ request()->is('feed') ? 'active text-primary' : '' }}">Feed</a></li>
                <li><a href="/komunitas" style="color: black;"
                        class="nav-link px-2 {{ request()->is('komunitas') ? 'active text-primary' : '' }}">Komunitas</a>
                </li>
                <li><a href="/cari_avatar" style="color: black;"
                        class="nav-link px-2 {{ request()->is('cari_avatar') ? 'active text-primary' : '' }}">Avatar</a>
                </li>
            </ul>

            <div class="col-md-3 text-end">
                @if (Auth::check())
                    <div class="btn-group">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('default-users.png') }}" alt="{{ Auth::user()->foto_user }}"
                                width="48" height="48" class="rounded-circle" />
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::check())
                                @if (Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="/admin/dashboard">Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item" href="/akun-anda">Akun Anda</a></li>
                                @endif
                            @else
                                <li><a class="dropdown-item" href="/akun-anda">Akun Anda</a></li>
                            @endif
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

</body>

</html>
