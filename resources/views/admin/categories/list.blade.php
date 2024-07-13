@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('category_focus')
    class="active has-sub"
@endsection

@section('searchbar')
    <form class="form-header" action="{{ route('admin#categories#search') }}" method="GET">
        <input class="au-input au-input--xl" type="text" name="searchKey"
            value="@if (isset($searchKey)) {{ $searchKey }} @endif" placeholder="Search for categories..." />

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('admin#category#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('msg'))
                        @if (session('msg') == 'category created successfully!')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> {{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('msg') == 'category deleted successfully!')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('msg') == 'category updated successfully!')
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('msg') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    @endif

                    @if ($categories && $categories->count() > 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th>updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->category_id }}</td>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>{{ $category->updated_at->format('j-F-Y') }}</td>


                                            <td>
                                                <div class="table-data-feature">
                                                    <a
                                                        href="{{ route('admin#category#updatepage', ['id' => $category->category_id]) }}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin#category#delete', ['id' => $category->category_id]) }}"
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
                            {{ $categories->links() }}
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
