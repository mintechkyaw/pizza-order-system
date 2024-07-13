@extends('auth.layouts.master')

@section('title', 'Login')


@section('content')
    <div class="login-logo">
        <a href="{{ route('login#Page') }}" class="text-decoration-none">
            <span class="px-2 h1 text-uppercase text-success bg-dark">Pizza</span>
            <span class="px-2 h1 text-uppercase text-dark bg-success ml-n1">buddy</span>
        </a>
    </div>
    <div class="login-form">

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('register#Page') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
