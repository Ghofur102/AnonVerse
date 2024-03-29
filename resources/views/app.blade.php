<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AnonVerse</title>
    <link rel="shortcut icon" style="border-radius: 50%;" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('iziToast-master/dist/css/iziToast.min.css') }}">

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

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
