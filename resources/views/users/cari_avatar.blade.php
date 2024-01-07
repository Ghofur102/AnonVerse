@extends('users.app_users')
@section('content')
<div class="row container">
    @foreach ($avatars as $num => $item)
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header text-center">
                <img src="{{ asset('default-users.png') }}" style="border-radius:50%;width:50px;" alt=""> <br>
                {{ $item->username }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
