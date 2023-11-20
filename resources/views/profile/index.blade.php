@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile/style.css') }}">
    @include('partials.header')
    @include('partials.sidebar')
    <section>
        <div class="row p-3 mb-4">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center p-4">
                        <a href="" data-bs-toggle="modal" data-bs-target="#changeprofile">
                            <img id="image" src="{{ Auth::user()->profile_pic }}" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px; padding-top: 11px;">
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="changeprofile" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title-image fs-5" id="staticBackdropLabel">Update Profile</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="changepic">
                                            <input type="file" name="picture" id="file_image">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="save" id=""
                                            class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="my-2" style="text-transform: capitalize;">
                            {{ Auth::user()->firstname }}
                        </h4>
                        <p class="text-muted mb-1">
                            {{ Auth::user()->course->name }}
                        </p>
                        <p class="text-muted mb-4">
                            Year Level {{ Auth::user()->year_level }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">School ID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->school_id }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9" style="text-transform: capitalize;">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->middlename }}
                                    {{ Auth::user()->lastname }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Course</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->course->name }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Year Level</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->year_level }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->mobilenumber }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9" style="text-transform: capitalize;">
                                <p class="text-muted mb-0">
                                    {{ Auth::user()->address }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p id="changeinput">
                                    Password</p>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-outline-danger ml-5" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Change</button>
                            </div>
                        </div>
                        <!-- modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class=" modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title-password">Change Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('password.update') }}" method="POST"
                                            id="form_change_password">
                                            @csrf
                                            @method('put')
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="current_password"
                                                    id="current_password" placeholder="name@example.com">
                                                <label>Current Password</label>
                                                <small><strong>
                                                        @foreach ($errors->updatePassword->get('current_password') as $message)
                                                            {{ $message }}
                                                        @endforeach
                                                    </strong></small>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="name@example.com">
                                                <label>New Password</label>
                                            </div>
                                            <div class="form-floating">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Password">
                                                <label>Confirm Password</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <input type="submit" id="changepass" value="Change Password"
                                                    name="submit-changepass" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
            </div>
        </div>
    </section>
@endsection
