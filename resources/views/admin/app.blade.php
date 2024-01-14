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
    <script>
        @if ($errors->any())
            alert('{{ $errors->first() }}');
        @endif
        @if (session('success'))
            alert("{{ session('success') }}");
        @endif
    </script>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">ADMIN ANONVERSE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item mb-3">
                            <a href="/" class="text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="currentColor" d="M4 21v-9.375L2.2 13L1 11.4L12 3l11 8.4l-1.2 1.575l-1.8-1.35V21zm4-6q-.425 0-.712-.288T7 14q0-.425.288-.712T8 13q.425 0 .713.288T9 14q0 .425-.288.713T8 15m4 0q-.425 0-.712-.288T11 14q0-.425.288-.712T12 13q.425 0 .713.288T13 14q0 .425-.288.713T12 15m4 0q-.425 0-.712-.288T15 14q0-.425.288-.712T16 13q.425 0 .713.288T17 14q0 .425-.288.713T16 15"/></svg>
                            </a>
                            <a href="/logout" class="text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="currentColor" d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z"/></svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/dashboard">
                                <button class="btn btn-outline-primary w-100 mb-3">
                                    Home
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kategori-komunitas">
                                <button class="btn btn-outline-secondary w-100 mb-3">Kategori Komunitas</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/approval-questions">
                                <button class="btn btn-outline-secondary w-100 mb-3">Approval Pertanyaan</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</body>

</html>
