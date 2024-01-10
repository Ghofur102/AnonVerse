@extends('users.app_users')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($categories as $item)
        <a href="/detail-komunitas/{{ $item->name_category }}" style="text-decoration:none;">
            <div class="card col-lg-2 col-md-4 col-sm-6 mx-2" style="max-width:10rem;">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/'.$item->image_category) }}" style="border-radius: 50%;width:50px;" alt="">
                    <br>
                    <b>{{ $item->name_category }}</b>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
