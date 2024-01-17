@extends('users.app_users')
@section('content')
    <div class="container">
        <a href="/detail-komunitas/{{ $answer->question->comunity_category->name_category }}" style="text-decoration: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m9.55 12l7.35 7.35q.375.375.363.875t-.388.875q-.375.375-.875.375t-.875-.375l-7.7-7.675q-.3-.3-.45-.675t-.15-.75q0-.375.15-.75t.45-.675l7.7-7.7q.375-.375.888-.363t.887.388q.375.375.375.875t-.375.875z" />
            </svg>
            <b>Kembali</b>
        </a>
        <div class="card">
            <div class="card-header">
                <img src="{{ asset('default-users.png') }}" style="border-radius: 50%;height: 50px; width: 50px;"
                    alt="">
                <b>{{ $answer->question->pertanyaan }}</b> <br>
                <div class="my-1">
                    <small>
                        <b>{{ $answer->question->User->username }}</b> -
                        {{ \Carbon\Carbon::parse($answer->question->created_at)->locale('id_ID')->diffForHumans() }}
                    </small>
                </div>
            </div>
            <div class="card-body">
                <img src="{{ asset('default-users.png') }}" style="border-radius: 50%;height: 50px;width: 50px;"
                    alt="">
                <small><b>{{ $answer->User->username }}</b>
                    - {{ \Carbon\Carbon::parse($answer->created_at)->locale('id_ID')->diffForHumans() }}</small>
                <p>
                    {!! $answer->jawaban !!}
                </p>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-light" onclick="LikeAnswer()">
                    <svg id="like-answer" class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="currentColor" d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965c.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21c.518.173.994.681 1.2 1.273c.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404c.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465c0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615c.849-.232 1.574-.787 2.132-1.41c.56-.627.914-1.28 1.039-1.639c.199-.575.356-1.539.428-2.59z"/></svg>
                </button>
                <a class="text-secondary" data-bs-toggle="collapse" href="#collapseComment" role="button"
                    aria-expanded="false" aria-controls="collapseComment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v15.575q0 .675-.612.938T20.3 20.3L18 18z"/></svg>
                </a>
                <div class="collapse mt-2" id="collapseComment">
                    @if (Auth::check())
                    <form id="FormStoreComment"
                        action="{{ route('comment.store', ['recipient_id' => $answer->User->id, 'sender_id' => Auth::user()->id, 'answer_id' => $answer->id]) }}"
                        method="post">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" id="comment" cols="15" rows="5" class="form-control" placeholder="Beri Komentar."></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" onclick="StoreComment()" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                @else
                    <form action="" method="">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" id="comment" cols="15" rows="5" class="form-control" placeholder="Beri Komentar."></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                @endif
                {{-- Komentar Utama --}}
                @foreach ($answer->comments as $comment)
                    <div class="card mb-3">
                        @if ($comment->parent_id == null)
                            <div class="card-body">
                                <div class="d-flex justify-content-start">
                                    <div class="">
                                        <img src="{{ asset('default-users.png') }}" width="50px" height="50px"
                                            style="border-radius: 50%;" alt="">
                                        <b style="color:skyblue;">{{ $comment->Sender->username }}</b>
                                    </div>
                                    <div class="mx-2" style="margin-top:10px;">
                                        <p>{!! $comment->comment !!}
                                    </div>
                                </div>
                                <div class="card-footer mt-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 16 16">
                                            <path fill="currentColor"
                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59c-.125.36-.479 1.013-1.04 1.639c-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545c1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484c.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464c.201-.263.38-.578.488-.901c.11-.33.172-.762.004-1.149c.069-.13.12-.269.159-.403c.077-.27.113-.568.113-.857c0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362a1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272c-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05a9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164c-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868c-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65c1.095-.3 1.977-.996 2.614-1.708c.635-.71 1.064-1.475 1.238-1.978c.243-.7.407-1.768.482-2.85c.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725a.5.5 0 0 0 .595.644l.003-.001l.014-.003l.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164c.175.058.45.3.57.65c.107.308.087.67-.266 1.022l-.353.353l.353.354c.043.043.105.141.154.315c.048.167.075.37.075.581c0 .212-.027.414-.075.582c-.05.174-.111.272-.154.315l-.353.353l.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353l.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                        </svg>
                                    </span>
                                    <a style="text-decoration: none;" class="text-secondary" data-bs-toggle="collapse"
                                        href="#collapseExample{{ $comment->id }}" role="button" aria-expanded="false"
                                        aria-controls="collapseExample{{ $comment->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v15.575q0 .675-.612.938T20.3 20.3L18 18z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="collapse" id="collapseExample{{ $comment->id }}">
                            <div class="mx-5">
                                @if (Auth::check())
                                    <form id="FormReplyStoreComment{{ $comment->id }}"
                                        action="{{ route('comment.store', ['recipient_id' => $comment->Sender->id, 'sender_id' => Auth::user()->id, 'answer_id' => $answer->id, 'parent_id' => $comment->id]) }}"
                                        method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea name="comment" id="reply-comment-{{ $comment->id }}" cols="15" rows="5" class="form-control"
                                                placeholder="Beri Komentar."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary"
                                                onclick="ReplyStoreComment({{ $comment->id }})">Kirim</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea name="comment" id="comment" cols="15" rows="5" class="form-control"
                                                placeholder="Beri Komentar."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                @endif
                                @foreach ($comment->CommentChild as $reply_comment)
                                    {{-- Balasan Komentar --}}
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start">
                                                <div class="">
                                                    <img src="{{ asset('default-users.png') }}" width="50px"
                                                        height="50px" style="border-radius: 50%;" alt="">
                                                    <b>{{ $reply_comment->Sender->username }}</b>
                                                </div>
                                                <div class="mx-2" style="margin-top:10px;">
                                                    <p>
                                                        {!! $reply_comment->comment !!}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer mt-2 mb-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 16 16">
                                                        <path fill="currentColor"
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59c-.125.36-.479 1.013-1.04 1.639c-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545c1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484c.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464c.201-.263.38-.578.488-.901c.11-.33.172-.762.004-1.149c.069-.13.12-.269.159-.403c.077-.27.113-.568.113-.857c0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362a1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272c-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05a9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164c-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868c-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65c1.095-.3 1.977-.996 2.614-1.708c.635-.71 1.064-1.475 1.238-1.978c.243-.7.407-1.768.482-2.85c.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725a.5.5 0 0 0 .595.644l.003-.001l.014-.003l.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164c.175.058.45.3.57.65c.107.308.087.67-.266 1.022l-.353.353l.353.354c.043.043.105.141.154.315c.048.167.075.37.075.581c0 .212-.027.414-.075.582c-.05.174-.111.272-.154.315l-.353.353l.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353l.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                                    </svg>
                                                </span>
                                                <a style="text-decoration:none;" class="text-secondary"
                                                    data-bs-toggle="collapse"
                                                    href="#collapseExample2{{ $reply_comment->id }}" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample2{{ $reply_comment->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v15.575q0 .675-.612.938T20.3 20.3L18 18z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="collapse" id="collapseExample2{{ $reply_comment->id }}">
                                                @if (Auth::check())
                                                    <form
                                                        action="{{ route('comment.store', ['recipient_id' => $reply_comment->Sender->id, 'sender_id' => Auth::user()->id, 'answer_id' => $answer->id, 'parent_id' => $reply_comment->id, 'parent_main_id' => $comment->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <textarea name="comment" id="comment" cols="15" rows="5" class="form-control"
                                                                placeholder="Beri Komentar."></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form action="" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <textarea name="comment" id="comment" cols="15" rows="5" class="form-control"
                                                                placeholder="Beri Komentar."></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="button" class="btn btn-primary">Kirim</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($comment->CommentMainChild as $reply2_comment)
                                        {{-- Balasan Komentar --}}
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start">
                                                    <div class="">
                                                        <img src="{{ asset('default-users.png') }}" width="50px"
                                                            height="50px" style="border-radius: 50%;" alt="">
                                                        <b>{{ $reply2_comment->Sender->username }}</b>
                                                    </div>
                                                    <div class="mx-2" style="margin-top:10px;">
                                                        <p>
                                                            {!! $reply2_comment->comment !!}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-footer mt-2 mb-2">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 16 16">
                                                            <path fill="currentColor"
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59c-.125.36-.479 1.013-1.04 1.639c-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545c1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484c.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464c.201-.263.38-.578.488-.901c.11-.33.172-.762.004-1.149c.069-.13.12-.269.159-.403c.077-.27.113-.568.113-.857c0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362a1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272c-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05a9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164c-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868c-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65c1.095-.3 1.977-.996 2.614-1.708c.635-.71 1.064-1.475 1.238-1.978c.243-.7.407-1.768.482-2.85c.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725a.5.5 0 0 0 .595.644l.003-.001l.014-.003l.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164c.175.058.45.3.57.65c.107.308.087.67-.266 1.022l-.353.353l.353.354c.043.043.105.141.154.315c.048.167.075.37.075.581c0 .212-.027.414-.075.582c-.05.174-.111.272-.154.315l-.353.353l.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353l.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                                        </svg>
                                                    </span>
                                                    <a style="text-decoration:none;" class="text-secondary"
                                                        data-bs-toggle="collapse"
                                                        href="#collapseExample21{{ $reply2_comment->id }}" role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseExample21{{ $reply2_comment->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v15.575q0 .675-.612.938T20.3 20.3L18 18z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="collapse" id="collapseExample21{{ $reply2_comment->id }}">
                                                    @if (Auth::check())
                                                        <form
                                                            action="{{ route('comment.store', ['recipient_id' => $reply2_comment->Sender->id, 'sender_id' => Auth::user()->id, 'answer_id' => $answer->id, 'parent_id' => $reply2_comment->id, 'parent_main_id' => $comment->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <textarea name="comment" id="comment" cols="15" rows="5" class="form-control"
                                                                    placeholder="Beri Komentar."></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Kirim</button>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <form action="" method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <textarea name="comment" id="comment" cols="15" rows="5" class="form-control"
                                                                    placeholder="Beri Komentar."></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="button"
                                                                    class="btn btn-primary">Kirim</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        @if (Auth::check())
            function LikeAnswer() {
                $.ajax({
                    url: '/like-answer/{{ $answer->User->id }}/{{ Auth::user()->id }}/{{ $answer->id }}',
                    method: 'POST',
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if ($("#like-answer").hasClass('text-secondary')) {
                            $("#like-answer").removeClass('text-secondary');
                            $("#like-answer").addClass('text-primary');
                        } else {
                            $("#like-answer").removeClass('text-primary');
                            $("#like-answer").addClass('text-secondary');
                        }
                    },
                    error: function (xhr, error, status) {
                        alert(xhr.responseText);
                    }
                });
            }
        @endif
        function StoreComment() {
            $("#FormStoreComment").off("submit");
            $("#FormStoreComment").submit(function(event) {
                event.preventDefault();
                let route = $("#FormStoreComment").attr("action");
                let data = new FormData($("#FormStoreComment")[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#comment").val('');
                    },
                    error: function(xhr, error, status) {
                        alert(xhr.responseText);
                    }
                });
            });
        }

        function ReplyStoreComment(id) {
            $("#FormReplyStoreComment" + id).off("submit");
            $("#FormReplyStoreComment" + id).submit(function(event) {
                event.preventDefault();
                let route = $("#FormReplyStoreComment" + id).attr("action");
                let data = new FormData($("#FormReplyStoreComment" + id)[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#reply-comment-" + id).val('');
                    },
                    error: function(xhr, error, status) {
                        alert(xhr.responseText);
                    }
                });
            });
        }
    </script>
@endsection
