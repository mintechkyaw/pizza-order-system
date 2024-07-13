@extends('admin.layouts.master')

@section('title', 'Product Create Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('admin#products#list') }}"><button
                                class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-7 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#product#create') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="product-name" class="control-label mb-1">Name</label>
                                    <input id="product-name" name="productName" type="text"
                                        value="{{ old('productName') }}"
                                        class="form-control @error('productName') border border-danger @enderror"
                                        placeholder="Enter product name" aria-required="true" aria-invalid="false">
                                    @error('productName')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="waiting-times" class="control-label mb-1">Waiting Times</label>
                                    <select class="form-control @error('waitingTimes') border border-danger @enderror"
                                        name="waitingTimes" id="waiting-times">
                                        <option value="">Choose Waiting Times</option>
                                        <option value="15">15 min</option>
                                        <option value="20">20 min</option>
                                        <option value="25">25 min</option>
                                        <option value="30">30 min</option>
                                        <option value="35">35 min</option>
                                        <option value="40">40 min</option>

                                    </select>
                                    @error('waitingTimes')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category-name" class="control-label mb-1">Category</label>
                                    <select class="form-control @error('categoryId') border border-danger @enderror"
                                        name="categoryId" id="category-name">
                                        <option value="">Choose Pizza Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->name }} </option>
                                        @endforeach

                                    </select>
                                    @error('categoryId')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="product-description" class="control-label mb-1">Description</label>
                                    <textarea class="form-control @error('productDescription') border border-danger @enderror" name="productDescription"
                                        placeholder="Enter product description..." id="product-description" rows="2"></textarea>
                                    @error('productDescription')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-7">
                                        <label for="product-photo" class="control-label mb-1">Product Image</label>
                                        <input id="product-photo" name="productPhoto" type="file"
                                            value="{{ old('productPhoto') }}"
                                            class="form-control @error('productPhoto') border border-danger @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('productPhoto')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-5">
                                        <label for="product-price" class="control-label mb-1">Price</label>
                                        <input id="product-price" name="productPrice" type="number"
                                            value="{{ old('productPrice') }}"
                                            class="form-control @error('productPrice') border border-danger @enderror"
                                            placeholder="Enter pizza price..." aria-required="true" aria-invalid="false">
                                        @error('productPrice')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create </span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
