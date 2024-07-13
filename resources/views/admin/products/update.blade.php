@extends('admin.layouts.master')

@section('title', 'Product Update Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class= "container-fluid">
                <div class="col-lg-7 offset-2">
                    <div class="card">
                        <form class="card-body" action="{{ route('admin#product#update', ['id' => $product->product_id]) }}"
                            method="post" style="display: block" enctype="multipart/form-data">
                            @csrf
                            <h3 class="card-title text-center title-1">Edit Your Product Info</h3>
                            <div class="d-flex py-3 align-items-center">
                                <label for="product-img" class="border border-3">
                                    @if ($product->name)
                                        <img class="card-img profileimage"
                                            src="{{ asset('storage/' . $product->product_photo_path) }}"
                                            alt="{{ Auth::user()->name }}">
                                    @else
                                        <img class="card-img profileimage" src="{{ asset('image/defaultprofile.png') }}"
                                            alt="{{ Auth::user()->name }}">
                                    @endif

                                    @error('productPhoto')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </label>

                                <input style="display:none" type="file" name="productPhoto" id="product-img">

                                <div class="mx-5 card-text text-dark">
                                    <div>
                                        <div class="d-flex my-2"><label for="name"><i
                                                    class="fas fa-pizza-slice me-2"></i></label>
                                            <input id="name" name="productName" type="text"
                                                class="mb-2 @error('categoryName') border border-danger @enderror"
                                                value="{{ old('productName', $product->name) }}">
                                        </div>
                                        @error('productName')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="d-flex my-2"><label for="category"><i
                                                    class="fa-solid fa-table-cells-large me-2"></i></label>
                                            <select class="border-0 @error('categoryId')  border-danger @enderror"
                                                name="categoryId" id="category-name">
                                                <option value="">Choose Pizza Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->category_id }}"
                                                        @selected($category->category_id == $product->category_id)>
                                                        {{ $category->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('categoryId')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="d-flex  my-2"><label for="email"><i
                                                    class="fa-solid fa-align-left me-2"></i></label>
                                            <textarea class="@error('productDescription')border border-danger @enderror" name="productDescription" id=""
                                                cols="30" rows="1">{{ old('productDescription', $product->description) }}</textarea>

                                        </div>
                                        @error('productDescription')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="d-flex my-2"><label for="price"><i
                                                    class="fas fa-dollar-sign me-2"></i></label>
                                            <input style="width: fit-content" id="price" name="productPrice"
                                                type="text"
                                                class="mb-2 @error('productPrice') border border-danger @enderror"
                                                value="{{ old('productPrice', $product->price) }}"> Kyats

                                        </div>
                                        @error('productPrice')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="d-flex  my-2"><label for="address"><i
                                                    class="fa-solid fa-hourglass-half mt-2 me-2"></i></label>
                                            <select class="border-0 @error('waitingTimes')  border-danger @enderror"
                                                name="waitingTimes" id="waiting-times">
                                                <option value="">Choose Waiting Times</option>
                                                <option value="15" @selected($product->waiting_times == 15)>15 min</option>
                                                <option value="20" @selected($product->waiting_times == 20)>20 min</option>
                                                <option value="25" @selected($product->waiting_times == 25)>25 min</option>
                                                <option value="30" @selected($product->waiting_times == 30)>30 min</option>
                                                <option value="35" @selected($product->waiting_times == 36)>35 min</option>
                                                <option value="40" @selected($product->waiting_times == 40)>40 min</option>
                                            </select>
                                        </div>
                                        @error('waitingTimes')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="py-2 form-control btn btn-info" onclick="toggleEdit()"><i
                                    class="fa-solid fa-floppy-disk"></i> Save
                                Your Product Info...</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <textarea id="myTextarea"></textarea>
@endsection
