@extends('users.app_users')
@section('content')
    <div class="text-center">
        <h3>Komunitas {{ $category->name_category }}</h3>
        <img src="{{ asset('storage/' . $category->image_category) }}" style="border-radius: 50%;width: 75px;height: 75px;"
            alt="">
    </div>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="questions-tab" data-bs-toggle="tab" data-bs-target="#questions-tab-pane"
                    type="button" role="tab" aria-controls="questions-tab-pane"
                    aria-selected="true">Pertanyaan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="answers-tab" data-bs-toggle="tab" data-bs-target="#answers-tab-pane"
                    type="button" role="tab" aria-controls="answers-tab-pane" aria-selected="false">Jawaban</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button"
                    role="tab" aria-controls="users-tab-pane" aria-selected="false">Teraktif</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="questions-tab-pane" role="tabpanel" aria-labelledby="questions-tab"
                tabindex="0">
                <div class="card mt-2">
                    <div class="card-body">
                        @if (Auth::check())
                            <form
                                action="{{ route('store.question', ['comunity_category_id' => $category->id, 'user_id' => Auth::user()->id]) }}"
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label> <br>
                                    <small class="text-info">Setelah mengirim pertanyaan, tunggu admin memverifikasi
                                        pertanyaan anda.</small>
                                    <textarea name="pertanyaan" id="pertanyaan" class="form-control" cols="15" rows="5"
                                        placeholder="Beri pertanyaan."></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('store.question', ['comunity_category_id' => $category->id]) }}"
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label> <br>
                                    <small class="text-info">Setelah mengirim pertanyaan, tunggu admin memverifikasi
                                        pertanyaan anda.</small>
                                    <textarea name="pertanyaan" id="pertanyaan" class="form-control" cols="15" rows="5"
                                        placeholder="Beri pertanyaan."></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="card-footer">
                        @foreach ($questions as $question)
                            <div class="card">
                                <div class="card-body d-flex justify-content-start">
                                    <div class="text-center"
                                        style="border: 1px solid black;padding: 5px;border-radius: 10px;">
                                        <img src="{{ asset('default-users.png') }}"
                                            style="border-radius: 50%;width: 50px;height: 50px;" alt=""> <br>
                                    </div>
                                    <div class="my-auto mx-2">
                                        <b>{{ $question->pertanyaan }}</b>
                                    </div>
                                </div>
                                <div class="mx-3 mb-2">
                                    <b>{{ $question->User->username }}</b> <br>
                                    <small>{{ \Carbon\Carbon::parse($question->created_at)->locale('id_ID')->diffForHumans() }}</small>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div style="border: 1px solid black;padding: 5px;border-radius: 10px;margin-left:16px;margin-bottom:10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="collapse"
                                            data-bs-target="#collapseAnswer{{ $question->id }}" width="25"
                                            height="25" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-2 2v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15q.4 0 .775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseAnswer{{ $question->id }}">
                                    <div class="card card-body">
                                        @if (Auth::check())
                                            <form
                                                action="{{ route('store.answer', ['question_id' => $question->id, 'comunity_category_id' => $question->comunity_category_id, 'user_id' => Auth::user()->id]) }}"
                                                method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <textarea name="jawaban" id="myeditorinstance" class="form-control" cols="15" rows="5"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        @else
                                            <form
                                                action="{{ route('store.answer', ['question_id' => $question->id, 'comunity_category_id' => $question->comunity_category_id]) }}"
                                                method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <textarea name="jawaban" id="myeditorinstance" class="form-control" cols="15" rows="5"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="answers-tab-pane" role="tabpanel" aria-labelledby="answers-tab"
                tabindex="0">
                @foreach ($answers as $answer)
                    <div class="card mb-3">
                        <div class="card-header">
                            <img src="{{ asset('default-users.png') }}"
                                style="border-radius: 50%;width: 50px;height: 50px;" alt="">
                            <b>User</b>
                        </div>
                        <div class="card-body">
                            <b>
                                {{ $answer->question->pertanyaan }}
                            </b>
                            <p>
                                {!! Str::limit($answer->jawaban, 100, '...') !!}
                            </p>
                            <a href="{{ route('detail.answer', $answer->id) }}">
                                <button type="button" class="btn btn-primary">Lihat Detail</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">

            </div>
        </div>
    </div>
    {{-- <x-head.tinymce-config /> --}}
@endsection
