@extends('admin.layouts.master')

@section('title', 'Account')


@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-7 offset-2">
                    @if (session('msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('msg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->updateProfileInformation->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->updateProfileInformation->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">

                        <div id="normalPage" class="card-body" style="display: block">
                            <h3 class="card-title text-center title-1">Your Account Info</h3>
                            <div class="d-flex py-3 align-items-center">
                                @if (Auth::user()->profile_photo_path)
                                    <img class=" card-img img-thumbnail"
                                        src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="">
                                @else
                                    <img class="card-img img-thumbnail" src="{{ asset('image/defaultprofile.png') }}"
                                        alt="">
                                @endif
                                <div class="mx-5 card-text text-dark">
                                    <p class="my-3"><i class="fa-solid fa-user me-2"></i>
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="my-3"><i class="fa-solid fa-envelope me-2"></i>
                                        {{ Auth::user()->email }}
                                    </p>
                                    <p class="my-3"><i class="fa-solid fa-phone me-2"></i>
                                        {{ Auth::user()->phone }}
                                    </p>
                                    <p class="my-3"><i class="fa-solid fa-location-dot me-2"></i>
                                        {{ Auth::user()->address }}
                                    </p>
                                </div>
                            </div>
                            <button class="py-2 form-control btn btn-info" onclick="toggleEdit()"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit
                                Your Profile Info...</button>
                        </div>

                        <form style="display: none" action="{{ route('user-profile-information.update') }}" method="post"
                            id="editPage" class="card-body" style="display: block" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="card-title text-center title-1">Edit Your Account Info</h3>
                            <div class="d-flex py-3 align-items-center">
                                <label for="profile-img" class="border border-3">
                                    @if (Auth::user()->profile_photo_path)
                                        <img class="card-img profileimage"
                                            src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{Auth::user()->name}}">
                                    @else
                                        <img class="card-img profileimage"
                                            src="{{ asset('image/defaultprofile.png') }}"
                                            alt="{{Auth::user()->name}}">
                                    @endif
                                </label>
                                <input style="display:none" type="file" name="photo" id="profile-img">

                                <div class="mx-5 card-text text-dark">
                                    <div class="d-flex my-2"><label for="name"><i
                                                class="fa-solid fa-user me-2"></i></label>
                                        <input id="name" name="name" type="text" class="mb-2"
                                            value="{{ old('name', Auth::user()->name) }}">
                                    </div>

                                    <div class="d-flex  my-2"><label for="email"><i
                                                class="fa-solid fa-envelope me-2"></i></label>
                                        <input id="email" name="email" type="text" class="mb-2 w-2"
                                            value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                    <div class="d-flex  my-2"><label for="phone"><i
                                                class="fa-solid fa-phone me-2"></i></label>
                                        <input id="phone" name="phone" type="tel" class="mb-2"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                    </div>

                                    <div class="d-flex  my-2"><label for="address"><i
                                                class="fa-solid fa-location-dot me-2"></i></label>
                                        <input id="address" name="address" type="text" class="mb-2"
                                            value="{{ old('address', Auth::user()->address) }}">
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="py-2 form-control btn btn-info" onclick="toggleEdit()"><i
                                    class="fa-solid fa-floppy-disk"></i> Save
                                Your Profile Info...</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('editPage')
    <script>
        function toggleEdit() {
            var normalPage = document.getElementById("normalPage");
            var editPage = document.getElementById("editPage");
            let err = false;
            if (normalPage.style.display === "block") {
                normalPage.style.display = "none";
                editPage.style.display = "block";
            } else if (editPage.style.display === "block") {
                editPage.style.display = "none";
                normalPage.style.display = "block";
            }
        }
    </script>
@endpush
