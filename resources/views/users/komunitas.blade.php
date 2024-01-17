@extends('users.app_users')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($categories as $item)
                <div class="col-lg-2 col-md-4 col-sm-6 m-2">
                    <div class="card" style="max-width:10rem;">
                        <a href="/detail-komunitas/{{ $item->name_category }}" style="text-decoration:none;">
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $item->image_category) }}"
                                    style="border-radius: 50%;width:70px;height:70px;object-fit:cover;" alt="">
                                <br>
                                <b>{{ $item->name_category }}</b>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
