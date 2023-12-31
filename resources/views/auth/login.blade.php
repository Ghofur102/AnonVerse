@extends('app')

@section('content')
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }
            @media (max-width:578px) {
                .gambar {
                    display: none;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-sm-6 mb-5 mb-lg-0">
                    <div class="card cascading-right"
                        style="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(30px);">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">Login</h2>
                            <form action="{{ route('auth.login') }}" method="POST">
                                @csrf

                                <!-- Username input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Username</label>
                                    <input type="text" name="username" id="form3Example3" maxlength="25" class="form-control" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" name="password" id="form3Example4" class="form-control" />
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33"
                                        checked />
                                    <label class="form-check-label" for="form2Example33">
                                        Setuju dengan kebijakan privasi
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Login
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <span>Belum punya akun? <b class="text-primary">
                                        <a href="/" style="text-decoration: none;">register</a>
                                    </b></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-5 mb-lg-0">
                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4 gambar"
                        alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
@endsection
