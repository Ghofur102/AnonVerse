@extends('users.app_users')
@section('content')
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <div class="mx-auto mb-3" style="max-width: 58rem">
        <div class="d-flex justify-content-between">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="currentColor" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225z" />
            </svg>
            <button type="button" data-bs-toggle="modal" data-bs-target="#FormTambahPostingan" class="btn btn-primary">Tambah
                Feed</button>
            <div class="modal" tabindex="-1" id="FormTambahPostingan">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Postingan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="loading" class="d-flex justify-content-center my-3"></div>
                        <form id="tambah_postingan" action="{{ route('store.feed') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label for="Story" class="col-sm-2 col-form-label">Story</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="story" class="form-control" id="Story"
                                            placeholder="Cerita anda.">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="File" class="col-sm-2 col-form-label">Feed</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file" id="File" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" onclick="tambah_postingan()" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="currentColor" d="M6.23 20.23L8 22l10-10L8 2L6.23 3.77L14.46 12z" />
            </svg>
        </div>
    </div>
    <!--Section: Newsfeed-->
    @if ($count_feed >= 1)
        <section class="d-flex justify-content-center">
            <div class="card mb-5" style="max-width: 58rem">
                <div class="card-body">
                    <!-- Data -->
                    <div class="d-flex mb-3">
                        <a href="">
                            <img src="{{ asset('default-users.png') }}" class="border rounded-circle me-2" alt="Avatar"
                                style="height: 40px" />
                        </a>
                        <div>
                            <a href="" class="text-dark mb-0">
                                <strong>{{ $feed->User->username }}</strong>
                            </a>
                            <a href="" class="text-muted d-block" style="margin-top: -6px">
                                <small>{{ \Carbon\Carbon::parse($feed->created_at)->locale('id_ID')->diffForHumans() }}</small>
                            </a>
                        </div>
                    </div>
                    <!-- Description -->
                    <div>
                        <p>
                            {{ $feed->story }}
                        </p>
                    </div>
                </div>
                <!-- Media -->
                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                    @if ($feed->file != null)
                        @php
                            $extension = pathinfo($feed->file, PATHINFO_EXTENSION);
                            $extensionImage = ['png', 'jpeg', 'jpg'];
                            $extensionVideo = ['mp4'];
                        @endphp
                        @if (in_array(strtolower($extension), $extensionImage))
                            <img src="{{ asset('storage/' . $feed->file) }}" class="w-100" />
                        @elseif (in_array(strtolower($extension), $extensionVideo))
                            <video class="w-100" controls>
                                <source src="{{ asset('storage/' . $feed->file) }}" type="video/mp4">
                            </video>
                        @endif
                    @endif
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                </div>
                <!-- Media -->
                <!-- Interactions -->
                <div class="card-body" style="overflow-x: scroll;height:400px;">
                    <!-- Reactions -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                        d="M2 16h5v14H2zm21 14H9V15.197l3.042-4.563l.845-5.917A2.01 2.01 0 0 1 14.868 3H15a3.003 3.003 0 0 1 3 3v6h8a4.005 4.005 0 0 1 4 4v7a7.008 7.008 0 0 1-7 7" />
                                </svg>
                                <span>124</span>
                            </a>
                        </div>
                        <div>
                            <a href="" class="text-muted"> 8 comments </a>
                        </div>
                    </div>
                    <!-- Reactions -->

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between text-center border-top border-bottom mb-4">
                        <button type="button" class="btn btn-lg text-secondary" data-bs-ripple-color="dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="M2 16h5v14H2zm21 14H9V15.197l3.042-4.563l.845-5.917A2.01 2.01 0 0 1 14.868 3H15a3.003 3.003 0 0 1 3 3v6h8a4.005 4.005 0 0 1 4 4v7a7.008 7.008 0 0 1-7 7" />
                            </svg>
                            <b style="font-size:14px;">Like</b>
                        </button>
                        <button type="button" class="btn btn-lg text-primary" data-bs-ripple-color="dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4.615 17q-.69 0-1.152-.462Q3 16.075 3 15.385V4.615q0-.69.463-1.152Q3.925 3 4.615 3h14.77q.69 0 1.152.463q.463.462.463 1.152v13.518q0 .54-.497.745q-.497.205-.876-.174L17.923 17z" />
                            </svg>
                            <b style="font-size:14px;">Comment</b>
                        </button>
                        <button type="button" class="btn btn-lg text-primary" data-bs-ripple-color="dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M11 20L1 12l10-8v5c5.523 0 10 4.477 10 10c0 .273-.01.543-.032.81A8.999 8.999 0 0 0 13 15h-2z" />
                            </svg>
                            <b style="font-size:14px;">Share</b>
                        </button>
                    </div>
                    <!-- Buttons -->

                    <!-- Comments -->

                    <!-- Input -->
                    <div style="margin-bottom: 75px;">
                        <div class="d-flex mb-3">
                            <a href="">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/18.webp"
                                    class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                            </a>
                            <div class="form-outline w-100">
                                <textarea class="form-control" placeholder="Write a comment" id="textAreaExample" rows="2"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm text-primary border border-black float-end"
                            data-bs-ripple-color="dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                            </svg>
                            <b style="font-size: 14px;">Send</b>
                        </button>
                    </div>
                    <!-- Input -->

                    <!-- Answers -->

                    <!-- Single answer -->
                    <div class="d-flex mb-3 mt-3">
                        <a href="">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/8.webp" class="border rounded-circle me-2"
                                alt="Avatar" style="height: 40px" />
                        </a>
                        <div>
                            <div class="bg-light rounded-3 px-3 py-1">
                                <a href="" class="text-dark mb-0">
                                    <strong>Malcolm Dosh</strong> <br>
                                    <small>10h</small>
                                </a>
                                <a href="" class="text-muted d-block">
                                    <small>Lorem ipsum dolor sit amet consectetur,
                                        adipisicing elit. Natus, aspernatur!</small>
                                </a>
                            </div>
                            <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong> <b>12</b></a>
                            <a data-bs-toggle="collapse" href="#collapseExample" class="text-muted small me-2"
                                aria-expanded="false" aria-controls="collapseExample">
                                <strong>Reply</strong> <b>12</b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <!-- Input -->
                                <div class="mt-3" style="margin-bottom: 75px;">
                                    <div class="d-flex mb-3">
                                        <a href="">
                                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/18.webp"
                                                class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                                        </a>
                                        <div class="form-outline w-100">
                                            <textarea class="form-control" placeholder="Write a comment" id="textAreaExample" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm text-primary border border-black float-end"
                                        data-bs-ripple-color="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                        </svg>
                                        <b style="font-size: 14px;">Send</b>
                                    </button>
                                </div>
                                <!-- Input -->
                                <div class="mt-2 mb-2">
                                    <!-- Single answer -->
                                    <div class="d-flex mb-3">
                                        <a href="">
                                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/5.webp"
                                                class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                                        </a>
                                        <div>
                                            <div class="bg-light rounded-3 px-3 py-1">
                                                <a href="" class="text-dark mb-0">
                                                    <strong>Rhia Wallis</strong> <br>
                                                    <small>10h</small>
                                                </a>
                                                <a href="" class="text-muted d-block">
                                                    <small>Et tempora ad natus autem enim a distinctio
                                                        quaerat asperiores necessitatibus commodi dolorum
                                                        nam perferendis labore delectus, aliquid placeat
                                                        quia nisi magnam.</small>
                                                </a>
                                            </div>
                                            <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong>
                                                <b>12</b></a>
                                            <a data-bs-toggle="collapse" href="#collapseExample2"
                                                class="text-muted small me-2" aria-expanded="false"
                                                aria-controls="collapseExample2"><strong>Reply</strong></a>
                                            <div class="collapse" id="collapseExample2">
                                                <!-- Input -->
                                                <div class="mt-3" style="margin-bottom: 75px;">
                                                    <div class="d-flex mb-3">
                                                        <a href="">
                                                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/18.webp"
                                                                class="border rounded-circle me-2" alt="Avatar"
                                                                style="height: 40px" />
                                                        </a>
                                                        <div class="form-outline w-100">
                                                            <textarea class="form-control" placeholder="Write a comment" id="textAreaExample" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-sm text-primary border border-black float-end"
                                                        data-bs-ripple-color="dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                                        </svg>
                                                        <b style="font-size: 14px;">Send</b>
                                                    </button>
                                                </div>
                                                <!-- Input -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Answers -->

                    <!-- Comments -->
                </div>
                <!-- Interactions -->
            </div>
        </section>
    @endif
    <!--Section: Newsfeed-->
    <script>
        function tambah_postingan() {
            $("#tambah_postingan").submit(function(event) {
                event.preventDefault();
                let route = $(this).attr("action");
                let data = new FormData($(this)[0]);
                $("#tambah_postingan").css('display', 'none');
                $("#loading").html(`
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `);
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function(xhr, error, status) {
                        $("#tambah_postingan").css('display', 'block');
                        $("#loading").empty();
                        alert(xhr.responseText)
                    }
                });
            });
        }
    </script>
@endsection
