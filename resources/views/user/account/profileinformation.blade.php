@extends('user.layouts.master')

@section('title', 'Account')

@section('content')
    <div id="normalPage" style="display: flex" class="row w-50 mx-auto ">
        <div for="profile-img" class="mt-3 form-label col">
            @if (Auth::user()->profile_photo_path)
                <img class="img-fluid shadow" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                    alt="{{ Auth::user()->name }}">
            @else
                <img class="img-fluid shadow" src="{{ asset('image/defaultprofile.png') }}" alt="{{ Auth::user()->name }}">
            @endif

        </div>
        <div class="col">
            <label class="mt-2 form-control-label" for="name">Name</label>
            <input type="text" class="form-control shadow" disabled name="name" id="name"
                value="{{ old('name', Auth::user()->name) }}">
            <label class="mt-2 form-control-label" for="email">Email</label>
            <input type="email" class="form-control shadow" disabled name="email" id="email"
                value="{{ old('email', Auth::user()->email) }}">
            <label class="mt-2 form-control-label" for="phone">Phone</label>
            <input type="tel" class="form-control shadow" disabled name="phone" id="phone"
                value="{{ old('phone', Auth::user()->phone) }}">
            <label class="mt-2 form-control-label" for="address">Address</label>
            <input type="text" class="form-control shadow" disabled name="address" id="address"
                value="{{ old('address', Auth::user()->address) }}">
            <button class="mt-3 form-control rounded btn-primary shadow" onclick="toggleEdit()">Edit</button>

        </div>

    </div>

    <form id="editPage" style="display: none" class="row w-50 mx-auto "
        action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="profile-img" class="mt-3 form-label col">
            @if (Auth::user()->profile_photo_path)
                <img class="img-fluid shadow" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                    alt="{{ Auth::user()->name }}">
            @else
                <img class="img-fluid shadow" src="{{ asset('image/defaultprofile.png') }}"
                    alt="{{ Auth::user()->name }}">
            @endif
        </label>
        <input class="d-none" type="file" id="profile-img" name="photo">
        <div class="col">
            <label class="mt-2 form-control-label" for="name">Name</label>
            <input type="text" class="form-control shadow" name="name" id="name"
                value="{{ old('name', Auth::user()->name) }}">
            <label class="mt-2 form-control-label" for="email">Email</label>
            <input type="email" class="form-control shadow" name="email" id="email"
                value="{{ old('email', Auth::user()->email) }}">
            <label class="mt-2 form-control-label" for="phone">Phone</label>
            <input type="tel" class="form-control shadow" name="phone" id="phone"
                value="{{ old('phone', Auth::user()->phone) }}">
            <label class="mt-2 form-control-label" for="address">Address</label>
            <input type="text" class="form-control shadow" name="address" id="address"
                value="{{ old('address', Auth::user()->address) }}">
            <input type="submit" onclick="toggleEdit()" class="mt-3 form-control rounded btn-primary shadow" value="Save">
        </div>

    </form>
@endsection

@push('script')
    <script>
        function toggleEdit() {
            var normalPage = document.getElementById("normalPage");
            var editPage = document.getElementById("editPage");
            if (normalPage.style.display === "flex") {
                normalPage.style.display = "none";
                editPage.style.display = "flex";
            } else if (editPage.style.display === "flex") {
                editPage.style.display = "none";
                normalPage.style.display = "flex";
            }
        }
    </script>
@endpush
