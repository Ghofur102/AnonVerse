@extends('users.app_users')
@section('content')
<div class="container">
    <div class="row container avatar">
        <div class="input-group mb-3">
            <div class="form-outline" data-bs-input-init>
                <input id="search-input" placeholder="search" type="search" id="form1" class="form-control w-100" />
            </div>
            <button onclick="search()" id="button-search" type="button" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14" />
                </svg>
            </button>
        </div>
        @foreach ($avatars as $num => $item)
            @if (Auth::check())
                @if (Auth::user()->id == $item->id)
                @else
                    <div class="col-sm-12 col-md-6 col-lg-4 avatars">
                        <div class="card">
                            <div class="card-header text-center">
                                <img src="{{ asset('default-users.png') }}" style="border-radius:50%;width:50px;"
                                    alt=""> <br>
                                <b>{{ $item->username }}</b>
                            </div>
                            <div class="card-body">
                                <p style="font-size:14px">
                                    {{ $item->bio }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-primary">
                                        <a href="" style="color: white;text-decoration: none;">Lihat Profile</a>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <a href="" style="color: white;text-decoration: none;">Chat</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="col-sm-12 col-md-6 col-lg-4 avatars">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="{{ asset('default-users.png') }}" style="border-radius:50%;width:50px;"
                                alt=""> <br>
                            {{ $item->username }}
                        </div>
                        <div class="card-body">
                            {{ $item->bio }}
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-primary">
                                    <a href="" style="color: white;text-decoration: none;">Lihat Profile</a>
                                </button>
                                <button type="button" class="btn btn-primary">
                                    <a href="" style="color: white;text-decoration: none;">Chat</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $("input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endsection
