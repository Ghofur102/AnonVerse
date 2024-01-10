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
                    type="button" role="tab" aria-controls="questions-tab-pane" aria-selected="true">Pertanyaan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="answers-tab" data-bs-toggle="tab" data-bs-target="#answers-tab-pane"
                    type="button" role="tab" aria-controls="answers-tab-pane" aria-selected="false">Jawaban</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane"
                    type="button" role="tab" aria-controls="users-tab-pane" aria-selected="false">Teraktif</button>
            </li>
        </ul>
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="questions-tab-pane" role="tabpanel" aria-labelledby="questions-tab"
                tabindex="0">
                <div class="card mt-2">
                    <div class="card-body">
                        <form action="{{ route('store.question', ['comunity_category_id' => $category->id]) }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Pertanyaan</label> <br>
                                <small class="text-info">Setelah mengirim pertanyaan, tunggu admin memverifikasi pertanyaan anda.</small>
                                <textarea name="pertanyaan" id="pertanyaan" class="form-control" cols="15" rows="5"
                                    placeholder="Beri pertanyaan."></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="answers-tab-pane" role="tabpanel" aria-labelledby="answers-tab" tabindex="0">

            </div>
            <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">

            </div>
        </div>
    </div>
@endsection
