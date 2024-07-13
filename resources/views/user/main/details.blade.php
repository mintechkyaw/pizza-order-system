@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="pb-5 container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $product->product_photo_path) }}"
                                alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="h-auto col-lg-7 mb-30">
                <input id="userId" type="hidden" value="{{ Auth::user()->id }}" name="">
                <input id="pizzaId" type="hidden" value="{{ $product->product_id }}" name="">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="mb-3 d-flex">
                        <i class="mx-2 fa fa-eye"></i><i class="fa">{{ $product->view_count + 1 }}</i>
                    </div>
                    <h3 class="mb-4 font-weight-semi-bold">{{ $product->price }} Kyats </h3>
                    <p class="mb-4">{{ $product->description }}</p>
                    @if ($rating && $rating->count() > 0)
                        <select>
                            <option selected>{{ $rating->rating_count }}</option>
                        </select>
                        <input type="text" value="{{ $rating->message }}" disabled>
                    @else
                        <select id="rate-count" class="form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <input id="rate-msg" class="form-input" type="text" placeholder="what you think">
                        <button id="rate-submit" class="rounded btn btn-primary">Submit</button>
                    @endif






                    <div class="pt-2 mb-4 d-flex align-items-center">
                        <div class="mr-3 input-group quantity" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="rounded btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input id="qty" type="text"
                                class="mx-1 text-center border-0 rounded form-control bg-secondary" value="1">

                            <div class="input-group-btn">
                                <button class="rounded btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button id="addToCart" class="px-3 py-2 rounded btn btn-primary"><i
                                class="mr-1 fa fa-shopping-cart"></i> Add To
                            Cart</button>
                    </div>
                    <div class="pt-2 d-flex">
                        <strong class="mr-2 text-dark">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="px-2 text-dark" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="px-2 text-dark" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="px-2 text-dark" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="px-2 text-dark" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#addToCart').click(
                function() {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/user/addcart',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'userId': $('#userId').val(),
                            'quantity': $('#qty').val(),
                            'pizzaId': $('#pizzaId').val()
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.href =
                                    'http://127.0.0.1:8000/user/shop/home'
                            }
                        }

                    })
                }

            )
            $('#rate-submit').click(
                function() {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/user/rater',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            'rateCount': $('#rate-count').val(),
                            'pizzaId': $('#pizzaId').val(),
                            'rateMsg': $('#rate-msg').val()

                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.href =
                                    'http://127.0.0.1:8000/user/shop/home'
                            }
                        }
                    })
                })
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/viewcount',
                dataType: 'json',
                data: {
                    'productId': $('#pizzaId').val()
                }
            })

        })
    </script>
@endpush
