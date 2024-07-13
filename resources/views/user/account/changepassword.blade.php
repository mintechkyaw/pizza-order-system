@extends('user.layouts.master')

@section('title','changepassword')


@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid mt-4">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Password Update Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="cc-pament" class="control-label mb-1 text-dark">Old Password</label>
                                    <input id="cc-pament" name="current_password" type="password" value="{{old('current_password')}}"
                                        class="form-control @error('current_password') border border-danger @enderror"
                                        placeholder="Enter current password..." aria-required="true" aria-invalid="false">

                                    @error('current_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-pament" class="control-label mb-1  text-dark">New Passsword</label>
                                    <input id="cc-pament" name="new_password" type="password" value="{{old('new_password')}}"
                                        class="form-control @error('new_password') border border-danger @enderror"
                                        placeholder="Enter new password..." aria-required="true" aria-invalid="false">

                                    @error('new_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-pament" class="control-label mb-1 text-dark">Confirm New Password</label>
                                    <input id="cc\-pament" name="new_password_confirmation" type="password" value="{{old('new_password_confirmation')}}"
                                        class="form-control @error('new_password_confirmation') border border-danger @enderror"
                                        placeholder="Enter new password again..." aria-required="true" aria-invalid="false">

                                    @error('new_password_confirmation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                        <span id="payment-button-amount">Change Password </span>
                                        <i class="fa-solid fa-key"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
