@extends('admin.layouts.master')

@section('title', 'Home Page')

@section('home_focus')
    class="active has-sub"
@endsection


@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid text-justify">
                <div class="row">
                    <div class="card col m-2 " style="width: 18rem;">

                        <div class="card-body rounded">
                            <h5 class="card-title">Active User - {{$customers->count()}}</h5>
                            <p class="card-text">There are currently {{$customers->count()}} of Active users.</p>
                        </div>
                        <a href="{{ route('admin#customer#list') }}" class="form-control btn btn-primary mb-2">Customer
                            List</a>

                    </div>
                    <div class="card col m-2 " style="width: 18rem;">

                        <div class="card-body rounded">
                            <h5 class="card-title">Active Admin - {{$admins->count()}}</h5>
                            <p class="card-text">There are currently {{$admins->count()}} of Active users.</p>
                        </div>
                        <a href="{{ route('admin#customer#list') }}" class="form-control btn btn-primary mb-2">Customer
                            List</a>

                    </div>
                    <div class="card col m-2 " style="width: 18rem;">

                        <div class="card-body rounded">
                            <h5 class="card-title">Active Admin - 0</h5>
                            <p class="card-text">There are currently 0 of Active admins.</p>
                        </div>
                        <a href="{{ route('admin#list') }}" class="form-control btn btn-primary mb-2">Customer
                            List</a>

                    </div>
                </div>
                <div class="row">
                    <div class="card col m-2" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body ">
                            <h5 class="card-title">Most Sold Item</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="{{ route('admin#products#list') }}" class="form-control mb-2 btn btn-primary">Product
                                List</a>
                        </div>
                    </div>
                    <div class="card col m-2" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body ">
                            <h5 class="card-title">Most View Item</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="{{ route('admin#products#list') }}" class="form-control mb-2 btn btn-primary">Product
                                List</a>
                        </div>
                    </div>
                    <div class="card col m-2" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body ">
                            <h5 class="card-title">Most Sold Item</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="{{ route('admin#products#list') }}" class="form-control mb-2 btn btn-primary">Product
                                List</a>
                        </div>
                    </div>
                    <div class="card col m-2" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body ">
                            <h5 class="card-title">Most Sold Item</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="{{ route('admin#products#list') }}" class="form-control mb-2 btn btn-primary">Product
                                List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
