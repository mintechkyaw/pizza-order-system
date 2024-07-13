@extends('admin.layouts.master')

@section('title', 'Product List Page')

@section('product_focus')
    class="active has-sub"
@endsection

@section('searchbar')
    <form class="form-header" action="{{ route('admin#products#search') }}" method="GET">
        <input class="au-input au-input--xl" type="text" name="searchKey"
            value="@if (isset($searchKey)) {{ $searchKey }} @endif" placeholder="Search for products.." />

        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection


@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('admin#product#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('msg'))
                        @if (session('msg') == 'product created successfully!')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> {{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('msg') == 'product deleted successfully!')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('msg') == 'product updated successfully!')
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    @endif

                    @if ($products && $products->count() > 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="tr-shadow">
                                            <td style="width: 13%; ">
                                                <img src="{{ asset('storage/' . $product->product_photo_path) }}"
                                                    alt="productphoto" />
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>{{ $product->description }}</td>
                                            <td class="text-center">{{ $product->category_name }}
                                            </td>
                                            <td class="text-center">{{ $product->price }} Kyats </td>
                                            <td class="text-center"> <i class="zmdi zmdi-eye"></i>
                                                {{ $product->view_count }} </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a
                                                        href="{{ route('admin#product#updatepage', ['id' => $product->product_id]) }}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin#product#delete', ['id' => $product->product_id]) }}"
                                                        method="post">

                                                        @csrf
                                                        <button type="submit" class="item mx-2" data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach


                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    @else
                        <p class="mt-3 h3 text-center ">No Data Found!</p>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
