@extends('users.app_users')
@section('content')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/jumbotrons.css') }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z">
            </path>
        </symbol>
        <symbol id="arrow-right-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
        </symbol>
        <symbol id="check2-circle" viewBox="0 0 16 16">
            <path
                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
            <path
                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
        </symbol>
    </svg>
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <img src="{{ asset('logo.png') }}" style="border-radius: 50%;width:100px;height:100px;border:1px solid black;" alt="">
            <h1 class="text-body-emphasis">AnonVerse</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
               AnonVerse adalah website sosial media dimana anda bisa menjadi apapun yang anda mau, anda bisa menjadi karakter yang anda mau tanpa takut anda akan diketahui oleh orang yang anda kenal di dunia nyata.
            </p>
            <div class="mb-5">
                <a href="/feed">
                    <button class="mb-3 d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                        Lihat Feed
                        <svg class="bi ms-2" width="24" height="24">
                            <use xlink:href="#arrow-right-short" />
                        </svg>
                    </button>
                </a>
                <a href="/komunitas">
                    <button class="btn mb-3 btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                        Lihat Komunitas
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
            <svg class="bi mt-5 mb-3" width="48" height="48">
                <use xlink:href="#check2-circle" />
            </svg>
            <h1 class="text-body-emphasis">Keamanan Anda</h1>
            <p class="col-lg-6 mx-auto mb-4">
                Anda tidak perlu khawatir karena anda tidak akan dimintai data pribadi anda, anda bebas membuat avatar anda dan bertindak sesuka hati namun tetap sesuai dengan kebijakan yang kami buat.
            </p>
            <button class="btn btn-primary px-5 mb-5" type="button">
                Kebijakan Kami
            </button>
        </div>
    </div>
    <div class="my-5">
        <div class="p-5 text-center bg-body-tertiary">
            <div class="container py-5">
                <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><path fill="currentColor" d="M20 8H4V6h16Zm-2-6H6v2h12Zm-7.688 19.1l-3.3-3.3l1.4-1.4l1.9 1.9l5.3-5.3l1.4 1.4Z"/><path fill="currentColor" d="M22 10H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V12a2 2 0 0 0-2-2m0 12H2V12h20Z"/></svg>
                <h1 class="text-body-emphasis">Fitur Feed</h1>
                <p class="col-lg-8 mx-auto lead">
                    Kami menyediakan anda fitur feed untuk berbagi video maupun gambar yang anda mau ataupun anda ingin membagikan kisah anda.
                </p>
                <a href="/feed">
                    <button class="mb-3 d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                        Lihat Feed
                        <svg class="bi ms-2" width="24" height="24">
                            <use xlink:href="#arrow-right-short" />
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 640 512"><path fill="currentColor" d="M144 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160m368 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160M0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96H21.3C9.6 320 0 310.4 0 298.7M405.3 320h-.7c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7c58.9 0 106.7 47.8 106.7 106.7c0 11.8-9.6 21.3-21.3 21.3zM224 224a96 96 0 1 1 192 0a96 96 0 1 1-192 0m-96 261.3c0-73.6 59.7-133.3 133.3-133.3h117.4c73.6 0 133.3 59.7 133.3 133.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7"/></svg>
            <h1 class="text-body-emphasis">Fitur Komunitas</h1>
            <p class="lead">
               Komunitas berisi sekolompok orang yang berdiskusi hal yang sama-sama disukai, kalian bisa membuat pertanyaan atau menjawab pertanyaan dengan avatar yang lain dan bersama-sama membahas hal yang menyenangkan bersama.
            </p>
            <a href="/komunitas">
                <button class="btn mb-3 btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                    Lihat Komunitas
                </button>
            </a>
        </div>
    </div>
@endsection
