@extends('admin.app')
@section('content')
    <div class="mt-3 container">
        <div class="card">
            <div class="card-header">
                <h4>Kategori Komunitas</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori-komunitas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name_category" class="form-label">Nama Kategori</label>
                        <input type="text" name="name_category" id="name_category" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image_category" class="form-label">Gambar Kategori</label>
                        <input type="file" name="image_category" id="image_category" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    @foreach ($categories as $item)
                        <div class="card col-sm-6 col-md-4 col-lg-2 mx-2">
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $item->image_category) }}" alt=""
                                    style="border-radius: 50%;width:50px;height:50px;"> <br>
                                <b>{{ $item->name_category }}</b> <br>
                                <svg data-bs-toggle="modal" data-bs-target="#modal-edit{{ $item->id }}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15q.4 0 .775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                </svg>
                                <div class="modal" tabindex="-1" id="modal-edit{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kategori Komunitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('kategori-komunitas.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name_category" class="form-label">Nama Kategori</label>
                                                        <input type="text" name="name_category" id="name_category" value="{{ $item->name_category }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image_category" class="form-label">Gambar Kategori</label> <br>
                                                        <img src="{{ asset('storage/'.$item->image_category) }}" style="border-radius: 50%;width:50px;height:50px;" class="mb-3" alt="">
                                                        <input type="file" name="image_category" id="image_category" class="form-control">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <svg data-bs-toggle="modal" data-bs-target="#modal-delete{{ $item->id }}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5q0-.425.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8q-.425 0-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8q-.425 0-.712.288T13 9v7q0 .425.288.713T14 17" />
                                </svg>
                                <div class="modal" tabindex="-1" id="modal-delete{{ $item->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Kategori Komunitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin mau menghapus kategori komunitas '{{ $item->name_category }}'</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('kategori-komunitas.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
