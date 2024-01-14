@extends('users.app_users')
@section('content')
<div class="container">
    <a href="/detail-komunitas/{{ $answer->question->comunity_category->name_category }}" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="currentColor" d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875q-.375.375-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75q0-.375.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388q.375.375.375.875t-.375.875z"/></svg>
        <b>Kembali</b>
    </a>
    <div class="card">
        <div class="card-header">
            <img src="{{ asset('default-users.png') }}" style="border-radius: 50%;height: 50px; width: 50px;" alt="">
            <b>{{ $answer->question->pertanyaan }}</b> <br>
            <div class="my-1">
                <p>
                    <b>{{ $answer->question->User->username }}</b> -
                    {{ \Carbon\Carbon::parse($answer->question->created_at)->locale('id_ID')->diffForHumans() }}
                </p>
            </div>
        </div>
        <div class="card-body">
            <img src="{{ asset('default-users.png') }}" style="border-radius: 50%;height: 50px;width: 50px;" alt="">
            <p><b>{{$answer->User->username  }}</b>
               - {{ \Carbon\Carbon::parse($answer->created_at)->locale('id_ID')->diffForHumans() }}</p>
            <p>
                {!! $answer->jawaban !!}
            </p>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
@endsection
