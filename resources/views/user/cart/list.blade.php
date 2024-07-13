@extends('user.layouts.master')

@section('title', 'pizza cart')

@section('cart_focus', 'active')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        @if ($cart && $cart->count() > 0)
            <div class="row px-xl-5">

                <div id="cart-list" class="col-lg-8 table-responsive mb-5">

                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody class="align-middle">

                            @foreach ($cart as $item)
                                <tr>
                                    <input type="hidden" id="productId" value="{{ $item->product_id }}">

                                    <td class="align-middle">{{ $item->pizza_name }}</td>
                                    <td class="align-middle">{{ $item->price }} Kyats </td>
                                    <td class="align-middle">
                                        <input type="hidden" id="cartId" value="{{ $item->cart_id }}">

                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" id="qty"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $item->qty }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" id="total">{{ $item->price * $item->qty }} Kyats</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger rounded btn-remove"><i
                                                class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <hr>
                    {{ $cart->links() }}


                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="sub-total">{{ $subTotal }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="total-price">
                                    {{ $totalPrice }} Kyats
                                </h5>
                            </div>
                            <a id="checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                                href="{{ route('order') }}">Proceed
                                To Checkout</a><button id="clearcart"
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3">Clear Cart</button>
                        </div>

                    </div>
                </div>

            </div>
        @else
            <p class="mt-3 h3 text-center ">No Data Found!</p>
        @endif
    </div>
    <!-- Cart End -->
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/editcart',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'cartId': $parentNode.find('#cartId').val(),
                        'quantity': $parentNode.find('#qty').val()
                    },
                    success: function(response) {
                        $parentNode.find('#total').html(response.data[0]['qty'] * response.data[
                            0]['price'] + ' Kyats')
                        $('#sub-total').html(response.subtotal)
                        $('#total-price').html(response.totalprice + ' Kyats')
                    }
                })
            })

            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/editcart',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'cartId': $parentNode.find('#cartId').val(),
                        'quantity': $parentNode.find('#qty').val()
                    },
                    success: function(response) {
                        $parentNode.find('#total').html(response.data[0]['qty'] * response.data[
                            0]['price'] + ' Kyats')
                        $('#sub-total').html(response.subtotal)
                        $('#total-price').html(response.totalprice + ' Kyats')
                    }
                })
            })

            $('.btn-remove').click(function() {
                $parentNode = $(this).parents('tr');
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/deletecart',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'cartId': $parentNode.find('#cartId').val()
                    },
                    success: function(response) {
                        $parentNode.remove();
                        $('#sub-total').html(response.subtotal)
                        $('#total-price').html(response.totalprice + ' Kyats')
                    }
                })
            })

            $('#clearcart').click(function() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/clearcart',
                    type: 'get',
                    success: function(response) {
                        $('#cart-list').html(
                            '<p class="mt-3 h3 text-center ">No Data Found!</p>')
                        $('#checkout').remove()
                        $('#total-price').html('0 Kyats')
                        $('#sub-total').html('0')
                    }
                })
            })


        });
    </script>
@endpush
