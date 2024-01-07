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
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $feed->file) }}" style="object-fit:cover;" />
                            </div>
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
                                <span id="count-likes">{{ $feed->count_likes() }}</span>
                            </a>
                        </div>
                        <div>
                            <a href="" class="text-muted"> 0 comments </a>
                        </div>
                    </div>
                    <!-- Reactions -->

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between text-center border-top border-bottom mb-4">
                        @if (Auth::check())
                            @if ($feed->is_like(Auth::user()->id))
                                <button id="button-like" type="button" onclick="Like()" class="btn btn-lg text-primary"
                                    data-bs-ripple-color="dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                            d="M2 16h5v14H2zm21 14H9V15.197l3.042-4.563l.845-5.917A2.01 2.01 0 0 1 14.868 3H15a3.003 3.003 0 0 1 3 3v6h8a4.005 4.005 0 0 1 4 4v7a7.008 7.008 0 0 1-7 7" />
                                    </svg>
                                    <b style="font-size:14px;">Like</b>
                                </button>
                            @else
                                <button id="button-like" type="button" onclick="Like()"
                                    class="btn btn-lg text-secondary" data-bs-ripple-color="dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                            d="M2 16h5v14H2zm21 14H9V15.197l3.042-4.563l.845-5.917A2.01 2.01 0 0 1 14.868 3H15a3.003 3.003 0 0 1 3 3v6h8a4.005 4.005 0 0 1 4 4v7a7.008 7.008 0 0 1-7 7" />
                                    </svg>
                                    <b style="font-size:14px;">Like</b>
                                </button>
                            @endif
                        @else
                            <button type="button" class="btn btn-lg text-secondary" data-bs-ripple-color="dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                        d="M2 16h5v14H2zm21 14H9V15.197l3.042-4.563l.845-5.917A2.01 2.01 0 0 1 14.868 3H15a3.003 3.003 0 0 1 3 3v6h8a4.005 4.005 0 0 1 4 4v7a7.008 7.008 0 0 1-7 7" />
                                </svg>
                                <b style="font-size:14px;">Like</b>
                            </button>
                        @endif
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
                    <form id="FormCommentStore"
                        action="{{ route('comment.store', ['recipient_id' => $feed->User->id, 'sender_id' => Auth::user()->id, 'feed_id' => $feed->id]) }}"
                        method="post">
                        <div style="margin-bottom: 75px;">
                            <div class="d-flex mb-3">
                                <a href="">
                                    <img src="{{ asset('default-users.png') }}" class="border rounded-circle me-2"
                                        alt="Avatar" style="height: 40px" />
                                </a>
                                <div class="form-outline w-100">
                                    <textarea class="form-control" name="comment" placeholder="Write a comment" id="main-comment" rows="2"></textarea>
                                </div>
                            </div>
                            <button type="button" onclick="CommentStore()"
                                class="btn btn-sm text-primary border border-black float-end" data-bs-ripple-color="dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                </svg>
                                <b style="font-size: 14px;">Send</b>
                            </button>
                        </div>
                    </form>
                    <!-- Input -->

                    <!-- Answers -->

                    <div id="new-comment"></div>
                    <!-- Single answer -->
                    @foreach ($feed->comments as $item)
                        @if ($item->parent_id == null)
                            <div class="d-flex mb-3 mt-3">
                                <a href="">
                                    <img src="{{ asset('default-users.png') }}" class="border rounded-circle me-2"
                                        alt="Avatar" style="height: 40px" />
                                </a>
                                <div>
                                    <div class="bg-light rounded-3 px-3 py-1">
                                        <a href="" class="text-dark mb-0">
                                            <strong>{{ $item->Sender->username }}</strong> <br>
                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->diffForHumans() }}</small>
                                        </a>
                                        <a href="" class="text-muted d-block">
                                            <small>{{ $item->comment }}</small>
                                        </a>
                                    </div>
                                    @if (Auth::check())
                                        @if ($item->is_like(Auth::user()->id))
                                            <a onclick="LikeMainComment({{ $item->id }})"
                                                id="a-like-main-comment{{ $item->id }}"
                                                class="text-primary small ms-3 me-2"><strong>Like</strong> <b
                                                    id="count-likes-main-comment{{ $item->id }}">{{ $item->count_likes() }}</b></a>
                                        @else
                                            <a onclick="LikeMainComment({{ $item->id }})"
                                                id="a-like-main-comment{{ $item->id }}"
                                                class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                    id="count-likes-main-comment{{ $item->id }}">{{ $item->count_likes() }}</b></a>
                                        @endif
                                    @else
                                        <a class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                id="count-likes-main-comment{{ $item->id }}">{{ $item->count_likes() }}</b>
                                    @endif
                                    <a data-bs-toggle="collapse" href="#collapseExample{{ $item->id }}"
                                        class="text-muted small me-2" aria-expanded="false"
                                        aria-controls="collapseExample{{ $item->id }}">
                                        <strong>Reply</strong> <b>{{ $item->CommentChild()->count() + $item->CommentMainChild->count() }}</b>
                                    </a>
                                    <div class="collapse" id="collapseExample{{ $item->id }}">
                                        <!-- Input -->
                                        <form id="FormReplyCommentStore{{ $item->id }}"
                                            action="{{ route('comment.store', ['recipient_id' => $item->Sender->id, 'sender_id' => Auth::user()->id, 'feed_id' => $feed->id, 'parent_id' => $item->id]) }}"
                                            method="post">
                                            <div class="mt-3" style="margin-bottom: 75px;">
                                                <div class="d-flex mb-3">
                                                    <a href="">
                                                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/18.webp"
                                                            class="border rounded-circle me-2" alt="Avatar"
                                                            style="height: 40px" />
                                                    </a>
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control reply-comment" name="comment" placeholder="Write a comment" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <button type="button" onclick="ReplyCommentStore({{ $item->id }})"
                                                    class="btn btn-sm text-primary border border-black float-end"
                                                    data-bs-ripple-color="dark">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                                    </svg>
                                                    <b style="font-size: 14px;">Send</b>
                                                </button>
                                            </div>
                                        </form>
                                        <div id="new-reply-comment{{ $item->id }}"></div>
                                        <!-- Input -->
                                        @foreach ($item->CommentChild as $i)
                                            @if ($i->parent_main_id == null)
                                                <div class="mt-2 mb-2">
                                                    <!-- Single answer -->
                                                    <div class="d-flex mb-3">
                                                        <a href="">
                                                            <img src="{{ asset('default-users.png') }}"
                                                                class="border rounded-circle me-2" alt="Avatar"
                                                                style="height: 40px" />
                                                        </a>
                                                        <div>
                                                            <div class="bg-light rounded-3 px-3 py-1">
                                                                <a href="" class="text-dark mb-0">
                                                                    <strong>{{ $i->Sender->username }}</strong> <br>
                                                                    <small>{{ \Carbon\Carbon::parse($i->created_at)->locale('id_ID')->diffForHumans() }}</small>
                                                                </a>
                                                                <a href="" class="text-muted d-block">
                                                                    <small> {{ $i->comment }}</small>
                                                                </a>
                                                            </div>
                                                            @if (Auth::check())
                                                            @if ($i->is_like(Auth::user()->id))
                                                                <a onclick="LikeMainComment({{ $i->id }})"
                                                                    id="a-like-main-comment{{ $i->id }}"
                                                                    class="text-primary small ms-3 me-2"><strong>Like</strong> <b
                                                                        id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b></a>
                                                            @else
                                                                <a onclick="LikeMainComment({{ $i->id }})"
                                                                    id="a-like-main-comment{{ $i->id }}"
                                                                    class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                                        id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b></a>
                                                            @endif
                                                        @else
                                                            <a class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                                    id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b>
                                                        @endif
                                                            <a data-bs-toggle="collapse"
                                                                href="#collapseExample2{{ $i->id }}"
                                                                class="text-muted small me-2" aria-expanded="false"
                                                                aria-controls="collapseExample2{{ $i->id }}"><strong>Reply</strong></a>
                                                            <div class="collapse"
                                                                id="collapseExample2{{ $i->id }}">
                                                                <!-- Input -->
                                                                <form id="FormReply2CommentStore{{ $i->id }}"
                                                                    action="{{ route('comment.store', ['recipient_id' => $i->Sender->id, 'sender_id' => Auth::user()->id, 'feed_id' => $feed->id, 'parent_id' => $i->id, 'parent_main_id' => $item->id]) }}"
                                                                    method="post">
                                                                    <div class="mt-3" style="margin-bottom: 75px;">
                                                                        <div class="d-flex mb-3">
                                                                            <a href="">
                                                                                <img src="{{ asset('default-users.png') }}"
                                                                                    class="border rounded-circle me-2"
                                                                                    alt="Avatar" style="height: 40px" />
                                                                            </a>
                                                                            <div class="form-outline w-100">
                                                                                <textarea class="form-control reply2-comment" placeholder="Write a comment" name="comment" rows="2"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button"
                                                                            onclick="Reply2CommentStore({{ $i->id }})"
                                                                            class="btn btn-sm text-primary border border-black float-end"
                                                                            data-bs-ripple-color="dark">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill="currentColor"
                                                                                    d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                                                            </svg>
                                                                            <b style="font-size: 14px;">Send</b>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                                <!-- Input -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div id="new-reply2-comment{{ $i->id }}"></div>
                                            @foreach ($item->CommentMainChild as $i)
                                                <div class="mt-2 mb-2">
                                                    <!-- Single answer -->
                                                    <div class="d-flex mb-3">
                                                        <a href="">
                                                            <img src="{{ asset('default-users.png') }}"
                                                                class="border rounded-circle me-2" alt="Avatar"
                                                                style="height: 40px" />
                                                        </a>
                                                        <div>
                                                            <div class="bg-light rounded-3 px-3 py-1">
                                                                <a href="" class="text-dark mb-0">
                                                                    <strong>{{ $i->Sender->username }}</strong> <br>
                                                                    <small>{{ \Carbon\Carbon::parse($i->created_at)->locale('id_ID')->diffForHumans() }}</small>
                                                                </a>
                                                                <a href="" class="text-muted d-block">
                                                                    <small>
                                                                        @if ($i->parent_id != null)
                                                                            @ {{ $i->Recipient->username }}
                                                                        @endif {{ $i->comment }}
                                                                    </small>
                                                                </a>
                                                            </div>
                                                            @if (Auth::check())
                                                            @if ($i->is_like(Auth::user()->id))
                                                                <a onclick="LikeMainComment({{ $i->id }})"
                                                                    id="a-like-main-comment{{ $i->id }}"
                                                                    class="text-primary small ms-3 me-2"><strong>Like</strong> <b
                                                                        id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b></a>
                                                            @else
                                                                <a onclick="LikeMainComment({{ $i->id }})"
                                                                    id="a-like-main-comment{{ $i->id }}"
                                                                    class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                                        id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b></a>
                                                            @endif
                                                        @else
                                                            <a class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                                    id="count-likes-main-comment{{ $i->id }}">{{ $i->count_likes() }}</b>
                                                        @endif
                                                            <a data-bs-toggle="collapse"
                                                                href="#collapseExample2{{ $i->id }}"
                                                                class="text-muted small me-2" aria-expanded="false"
                                                                aria-controls="collapseExample2{{ $i->id }}"><strong>Reply</strong></a>
                                                            <div class="collapse"
                                                                id="collapseExample2{{ $i->id }}">
                                                                <!-- Input -->
                                                                <form id="FormReply2CommentStore{{ $i->id }}"
                                                                    action="{{ route('comment.store', ['recipient_id' => $i->Sender->id, 'sender_id' => Auth::user()->id, 'feed_id' => $feed->id, 'parent_id' => $i->id, 'parent_main_id' => $item->id]) }}"
                                                                    method="post">
                                                                    <div class="mt-3" style="margin-bottom: 75px;">
                                                                        <div class="d-flex mb-3">
                                                                            <a href="">
                                                                                <img src="{{ asset('default-users.png') }}"
                                                                                    class="border rounded-circle me-2"
                                                                                    alt="Avatar" style="height: 40px" />
                                                                            </a>
                                                                            <div class="form-outline w-100">
                                                                                <textarea class="form-control reply2-comment" placeholder="Write a comment" name="comment" rows="2"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button"
                                                                            onclick="Reply2CommentStore({{ $i->id }})"
                                                                            class="btn btn-sm text-primary border border-black float-end"
                                                                            data-bs-ripple-color="dark">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill="currentColor"
                                                                                    d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                                                            </svg>
                                                                            <b style="font-size: 14px;">Send</b>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                                <!-- Input -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
        @if (Auth::check())
            @if ($count_feed >= 1)
                function Like() {
                    $.ajax({
                        url: "/like-feed/{{ $feed->User->id }}/{{ Auth::user()->id }}/{{ $feed->id }}",
                        method: "POST",
                        headers: {
                            "X-Csrf-Token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if ($("#button-like").hasClass('text-secondary')) {
                                $("#button-like").removeClass('text-secondary');
                                $("#button-like").addClass('text-primary');
                                let c = parseInt($("#count-likes").text()) + 1;
                                $("#count-likes").html(c);
                            } else {
                                $("#button-like").addClass('text-secondary');
                                $("#button-like").removeClass('text-primary');
                                let c = parseInt($("#count-likes").text()) - 1;
                                $("#count-likes").html(c);
                            }
                        },
                        error: function(xhr, error, status) {
                            alert(xhr.responseText)
                        }
                    });
                }

                function LikeMainComment(id) {
                    $.ajax({
                        url: "/like-comment/{{ $feed->User->id }}/{{ Auth::user()->id }}/" + id,
                        method: "POST",
                        headers: {
                            "X-Csrf-Token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if ($("#a-like-main-comment" + id).hasClass('text-muted')) {
                                $("#a-like-main-comment" + id).removeClass('text-muted');
                                $("#a-like-main-comment" + id).addClass('text-primary');
                                let c = parseInt($("#count-likes-main-comment" + id).text()) + 1;
                                $("#count-likes-main-comment" + id).html(c);
                            } else {
                                $("#a-like-main-comment" + id).addClass('text-muted');
                                $("#a-like-main-comment" + id).removeClass('text-primary');
                                let c = parseInt($("#count-likes-main-comment" + id).text()) - 1;
                                $("#count-likes-main-comment" + id).html(c);
                            }
                        },
                        error: function(xhr, error, status) {
                            alert(xhr.responseText)
                        }
                    });
                }
            @endif

            function CommentStore() {
                let route = $("#FormCommentStore").attr('action');
                let data = new FormData($("#FormCommentStore")[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#main-comment").val('');
                        $("#new-comment").html(`
                    <div class="d-flex mb-3 mt-3">
                        <a href="">
                            <img src="{{ asset('default-users.png') }}" class="border rounded-circle me-2"
                                alt="Avatar" style="height: 40px" />
                        </a>
                        <div>
                            <div class="bg-light rounded-3 px-3 py-1">
                                <a href="" class="text-dark mb-0">
                                    <strong>${response.name_sender}</strong> <br>
                                    <small>1 detik yang lalu</small>
                                </a>
                                <a href="" class="text-muted d-block">
                                    <small>${response.comment}</small>
                                </a>
                            </div>
                                            <a onclick="LikeMainComment(${response.id})"
                                                id="a-like-main-comment${response.id}"
                                                class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                    id="count-likes-main-comment${response.id}">0</b></a>
                            <a data-bs-toggle="collapse" href="#collapseExample${response.id}" class="text-muted small me-2"
                                aria-expanded="false" aria-controls="collapseExample${response.id}">
                                <strong>Reply</strong> <b>12</b>
                            </a>
                            <div class="collapse" id="collapseExample${response.id}">
                                <!-- Input -->
                                <form id="FormReplyCommentStore${response.id}"
                                        action="/comment?feed_id=${response.feed_id}&recipient_id=${response.sender_id}&sender_id=${response.auth_user_id}"
                                        method="post">
                                        <input type="number" name="parent_id" value="${response.id}" hidden>
                                <div class="mt-3" style="margin-bottom: 75px;">
                                    <div class="d-flex mb-3">
                                        <a href="">
                                            <img src="{{ asset('default-users.png') }}"
                                                class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                                        </a>
                                        <div class="form-outline w-100">
                                            <textarea class="form-control reply-comment" name="comment" placeholder="Write a comment" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm text-primary border border-black float-end" onclick="ReplyCommentStore(${response.id})"
                                        data-bs-ripple-color="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4.4 19.425q-.5.2-.95-.088T3 18.5V14l8-2l-8-2V5.5q0-.55.45-.837t.95-.088l15.4 6.5q.625.275.625.925t-.625.925z" />
                                        </svg>
                                        <b style="font-size: 14px;">Send</b>
                                    </button>
                                </div>
                                </form>
                                <div id="new-reply-comment${response.id}"></div>
                            </div>
                        </div>
                    </div>
                        `);
                    },
                    error: function(xhr, error, status) {

                    }
                });

            }

            function ReplyCommentStore(id) {
                let route = $("#FormReplyCommentStore" + id).attr('action');
                let data = new FormData($("#FormReplyCommentStore" + id)[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $(".reply-comment").val('');
                        $("#new-reply-comment" + id).html(`
                                <div class="mt-2 mb-2">
                                    <!-- Single answer -->
                                    <div class="d-flex mb-3">
                                        <a href="">
                                            <img src="{{ asset('default-users.png') }}"
                                                class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                                        </a>
                                        <div>
                                            <div class="bg-light rounded-3 px-3 py-1">
                                                <a href="" class="text-dark mb-0">
                                                    <strong>${response.name_sender}</strong> <br>
                                                    <small>1 detik yang lalu</small>
                                                </a>
                                                <a href="" class="text-muted d-block">
                                                    <small> ${response.comment}</small>
                                                </a>
                                            </div>
                                            <a onclick="LikeMainComment(${response.id})"
                                                id="a-like-main-comment${response.id}"
                                                class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                    id="count-likes-main-comment${response.id}">0</b></a>
                                            <a data-bs-toggle="collapse" href="#collapseExample2${response.id}"
                                                class="text-muted small me-2" aria-expanded="false"
                                                aria-controls="collapseExample2${response.id}"><strong>Reply</strong></a>
                                            <div class="collapse" id="collapseExample2${response.id}">
                                                <!-- Input -->
                                                <form id="FormReply2CommentStore${response.id}"
                                                action="/comment?feed_id=${response.feed_id}&recipient_id=${response.sender_id}&sender_id=${response.auth_user_id}"
                                        method="post">
                                        <input type="number" name="parent_id" value="${response.id}" hidden>
                                        <input type="number" name="parent_main_id" value="${response.parent_id}" hidden>
                                                <div class="mt-3" style="margin-bottom: 75px;">
                                                    <div class="d-flex mb-3">
                                                        <a href="">
                                                            <img src="{{ asset('default-users.png') }}"
                                                                class="border rounded-circle me-2" alt="Avatar"
                                                                style="height: 40px" />
                                                        </a>
                                                        <div class="form-outline w-100">
                                                            <textarea class="form-control reply2-comment" name="comment" placeholder="Write a comment"  rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="button" onclick="Reply2CommentStore(${response.id})"
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
                                                </form>
                                                <!-- Input -->
                                                <div id="new-reply2-comment${response.id}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `);
                    },
                    error: function(xhr, error, status) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                });

            }

            function Reply2CommentStore(id) {
                let route = $("#FormReply2CommentStore" + id).attr('action');
                let data = new FormData($("#FormReply2CommentStore" + id)[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $(".reply2-comment").val('');
                        $("#new-reply2-comment" + id).html(`
                                <div class="mt-2 mb-2">
                                    <!-- Single answer -->
                                    <div class="d-flex mb-3">
                                        <a href="">
                                            <img src="{{ asset('default-users.png') }}"
                                                class="border rounded-circle me-2" alt="Avatar" style="height: 40px" />
                                        </a>
                                        <div>
                                            <div class="bg-light rounded-3 px-3 py-1">
                                                <a href="" class="text-dark mb-0">
                                                    <strong>${response.name_sender}</strong> <br>
                                                    <small>1 detik yang lalu</small>
                                                </a>
                                                <a href="" class="text-muted d-block">
                                                    <small>@${response.name_recipient} ${response.comment}</small>
                                                </a>
                                            </div>
                                            <a onclick="LikeMainComment(${response.id})"
                                                id="a-like-main-comment${response.id}"
                                                class="text-muted small ms-3 me-2"><strong>Like</strong> <b
                                                    id="count-likes-main-comment${response.id}">0</b></a>
                                            <a data-bs-toggle="collapse" href="#collapseExample2${response.id}"
                                                class="text-muted small me-2" aria-expanded="false"
                                                aria-controls="collapseExample2${response.id}"><strong>Reply</strong></a>
                                            <div class="collapse" id="collapseExample2${response.id}">
                                                <!-- Input -->
                                                <form id="FormReply2CommentStore${response.id}"
                                                action="/comment?feed_id=${response.feed_id}&recipient_id=${response.sender_id}&sender_id=${response.auth_user_id}"
                                        method="post">
                                        <input type="number" name="parent_id" value="${response.id}" hidden>
                                        <input type="number" name="parent_main_id" value="${response.parent_id}" hidden>

                                                <div class="mt-3" style="margin-bottom: 75px;">
                                                    <div class="d-flex mb-3">
                                                        <a href="">
                                                            <img src="{{ asset('default-users.png') }}"
                                                                class="border rounded-circle me-2" alt="Avatar"
                                                                style="height: 40px" />
                                                        </a>
                                                        <div class="form-outline w-100">
                                                            <textarea class="form-control reply2-comment" name="comment" placeholder="Write a comment" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="button" onclick="Reply2CommentStore(${response.id})"
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
                                                </form>
                                                <!-- Input -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `);
                    },
                    error: function(xhr, error, status) {
                        alert(xhr.responseText);
                    }
                });

            }
        @endif
    </script>
@endsection
