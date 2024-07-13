@extends('user.layouts.master')

@section('title', 'Pizza Buddy')

@section('home_focus', 'active')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">


                <!-- Category Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form action="{{ route('user#shop') }}" method="GET">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input name="categoryId" type="checkbox" class="custom-control-input" checked id="category-all"
                                onchange="this.form.submit()">
                            <label class="custom-control-label" for="category-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>


                        @foreach ($categories as $category)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                                <input name="categoryId" type="checkbox" @checked($msg == $category->category_id)
                                    value="{{ $category->category_id }}" class="custom-control-input"
                                    id="{{ $category->name }}" onchange="this.form.submit()">
                                <label class="custom-control-label"
                                    for="{{ $category->name }}">{{ $category->name }}</label>
                                <span class="badge border font-weight-normal">1000</span>
                            </div>
                        @endforeach
                        <input type="submit" value="hehe" class="d-none">
                    </form>
                </div>
                <!-- Category End -->



                <div class="">
                    <a href="{{ route('order') }}"><button class="btn btn btn-warning w-100">Order</button></a>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button id="sorting" type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button id="pLow" class="dropdown-item bg-secondary">
                                            price: low - high</button>
                                        <button id="phigh" class="dropdown-item bg-secondary">
                                            price: high - low</button>
                                        <button id="vLow" class="dropdown-item bg-secondary">
                                            view: low - high</button>
                                        <button id="vhigh" class="dropdown-item bg-secondary">
                                            view: high - low</button>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item bg-secondary" href="#">10</a>
                                        <a class="dropdown-item bg-secondary" href="#">20</a>
                                        <a class="dropdown-item bg-secondary" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($datas->count() > 0)
                        <div id="productList" class="row">
                            @foreach ($datas as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img id="productPhoto" class="img-fluid w-100"
                                                src="{{ asset('storage/' . $product->product_photo_path) }}" alt="">

                                        </div>

                                        <div class=" text-center py-4">
                                            <input type="hidden" id="product-id" value="{{ $product->product_id }}">
                                            <a id="productId" class="h6 text-decoration-none text-truncate"
                                                href="{{ route('user#pizza#details', ['id' => $product->product_id]) }}"
                                                id="productName">{{ $product->name }} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 id="productPrice">{{ $product->price }} Kyats </h5>

                                            </div>
                                            <div id="productView"
                                                class="d-flex align-items-center justify-content-center mb-1">
                                                view - {{ $product->view_count }}
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    @endif

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#pLow').click(function() {
                $('#sorting').text('price: low to high')
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/productfilter',
                    type: 'get',
                    data: {
                        'status': 'pLow'
                    },
                    dataType: 'json',
                    success: function(response) {
                        var $list;
                        $.each(response, function(index, product) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img id="productPhoto" class="img-fluid w-100"
                                            src="{{ asset('storage/${product.product_photo_path}') }}" alt="">

                                    </div>

                                        <div class="col text-center py-4">
                                            <a id="productId" class="h6 text-decoration-none text-truncate"

                                                id="productName">${product.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 id="productPrice">${product.price} Kyats </h5>

                                            </div>
                                            <div id="productView"
                                                class="d-flex align-items-center justify-content-center mb-1">
                                                view - ${product.view_count}
                                            </div>
                                        </div>


                                </div>
                            </div>

                            `
                            $('#productList').html($list);

                        })
                    }
                })
            });

            $('#phigh').click(function() {
                $('#sorting').text('price: high to low')

                $.ajax({
                    url: 'http://127.0.0.1:8000/user/productfilter',
                    type: 'get',
                    data: {
                        'status': 'phigh'
                    },
                    dataType: 'json',
                    success: function(response) {
                        var $list;
                        $.each(response, function(index, product) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img id="productPhoto" class="img-fluid w-100"
                                            src="{{ asset('storage/${product.product_photo_path}') }}" alt="">

                                    </div>

                                        <div class="col text-center py-4">
                                            <a id="productId" class="h6 text-decoration-none text-truncate"
                                            href=""
                                                id="productName">${product.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 id="productPrice">${product.price} Kyats </h5>

                                            </div>
                                            <div id="productView"
                                                class="d-flex align-items-center justify-content-center mb-1">
                                                view - ${product.view_count}
                                            </div>
                                        </div>


                                </div>
                            </div>

                            `
                            $('#productList').html($list);

                        })
                    }
                })
            });

            $('#vLow').click(function() {
                $('#sorting').text('view: low to high')

                $.ajax({
                    url: 'http://127.0.0.1:8000/user/productfilter',
                    type: 'get',
                    data: {
                        'status': 'vLow'
                    },
                    dataType: 'json',
                    success: function(response) {
                        var $list;
                        $.each(response, function(index, product) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img id="productPhoto" class="img-fluid w-100"
                                            src="{{ asset('storage/${product.product_photo_path}') }}" alt="">

                                    </div>

                                        <div class="col text-center py-4">
                                            <a id="productId" class="h6 text-decoration-none text-truncate"
                                            href=""
                                                id="productName">${product.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 id="productPrice">${product.price} Kyats </h5>

                                            </div>
                                            <div id="productView"
                                                class="d-flex align-items-center justify-content-center mb-1">
                                                view - ${product.view_count}
                                            </div>
                                        </div>


                                </div>
                            </div>

                            `
                            $('#productList').html($list);

                        })
                    }
                })
            });

            $('#vhigh').click(function() {
                $('#sorting').text('view: high to low')
                $.ajax({
                    url: 'http://127.0.0.1:8000/user/productfilter',
                    type: 'get',
                    data: {
                        'status': 'vhigh'
                    },
                    dataType: 'json',
                    success: function(response) {
                        var $list;
                        $.each(response, function(index, product) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img id="productPhoto" class="img-fluid w-100"
                                            src="{{ asset('storage/${product.product_photo_path}') }}" alt="">

                                    </div>

                                        <div class="col text-center py-4">
                                            <a id="productId" class="h6 text-decoration-none text-truncate"
                                            href=""
                                                id="productName">${product.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5 id="productPrice">${product.price} Kyats </h5>

                                            </div>
                                            <div id="productView"
                                                class="d-flex align-items-center justify-content-center mb-1">
                                                view - ${product.view_count}
                                            </div>
                                        </div>


                                </div>
                            </div>

                            `
                            $('#productList').html($list);

                        })
                    }
                })
            });
        });
    </script>
@endpush
