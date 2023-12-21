@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">

    <section class="">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start"
            style="background-color: hsl(3, 20%, 96%); background: transparent; color: white">
            {{-- <div class="container"> --}}
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 service">
                    <h1 class="my-3 display-3 fw-bold ls-tight provide">
                        We Provide Best <br />
                        <div>
                            <span class="payment"><span class="E">E</span>-Payment Service</span>
                        </div>
                    </h1>
                    <p class="transaction">
                        "Transform transactions with our E-payment services—effortless, secure, and modern."
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card-body py-5 px-md-5">
                        <div class="login-form">
                            <form action="{{ route('login') }}" method="POST" id="session-form">
                                @csrf
                                <h2 class="login">Login</h2>
                                <div>
                                    <p class="fill">Please fill in this form to proceed!</p>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope-at">
                                                    <img src="{{ asset('/img/inbox.svg') }}">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control @error('identity') is-invalid @enderror" name="identity"
                                                placeholder="name@example.com" value="{{ old('identity') }}" autofocus
                                                required />
                                            <label for="floatingInput">Username or Email</label>
                                            @error('identity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="position-relative">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bi bi-key"><img src="{{ asset('/img/key.svg') }}"></i>
                                            </span>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="password" id="password" name="password" />
                                            <label for="password">Password</label>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit-login" class="btn btn-primary btn-lg">Login</button>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="{{ asset('js/login/index.js') }}"></script>
@endsection
