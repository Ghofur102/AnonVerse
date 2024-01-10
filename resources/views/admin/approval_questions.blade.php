@extends('admin.app')
@section('content')
    <div class="text-center mt-3">
        <h4>Approval Pertanyaan</h4>
    </div>
    <div class="container my-5" style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pertanyaan</th>
                    <th scope="col" class="text-center">Kategori Komunitas</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $num => $question)
                    <tr>
                        <th scope="row">{{ $num += 1 }}</th>
                        <td>{{ $question->pertanyaan }}</td>
                        <td class="text-center">{{ $question->comunity_category->name_category }}</td>
                        <td class="d-flex gap-2 justify-content-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-terima{{ $question->id }}"
                                class="btn btn-primary">Terima</button>
                            <div class="modal" tabindex="-1" id="modal-terima{{ $question->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Terima Pertanyaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <b>Apakah anda yakin sudah mengecek pertanyaan dan memang sudah sesuai?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <form action="{{ route('accept.question', $question) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Terima</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $question->id }}"
                                class="btn btn-danger">Tolak</button>
                            <div class="modal" tabindex="-1" id="modal-delete{{ $question->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Tolak Pertanyaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <b>Apakah anda yakin sudah membaca dengan saksama pertanyaan tersebut dan memang
                                                tidak sesuai?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <form action="{{ route('block.question', $question->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
