@extends('users.app_users')
@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-2 col-md-4 col-sm-6 mx-2" style="max-width:10rem;">
            <div class="card-body text-center">
                <img src="{{ asset('default-users.png') }}" style="border-radius: 50%;width:50px;" alt="">
                <br>
                <b>Kategori</b>
            </div>
        </div>
    </div>
</div>
@endsection
