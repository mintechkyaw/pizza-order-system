@extends('admin.layouts.master')

@section('customer_focus')
    class= "active has-sub"
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
                                <h2 class="title-1">Customer List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('msg'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> {{ session('msg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($customers && $customers->count() > 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center  ">
                                <thead>
                                    <tr>
                                        <th>Profile photo</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>address</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $user)
                                        <tr class="tr-shadow">
                                            <td style="width: 13%; ">
                                                @if ($user->profile_photo_path)
                                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                        alt="adminphoto" />
                                                @else
                                                    <img src="{{ asset('image/defaultprofile.png') }}" alt="adminphoto">
                                                @endif

                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->phone }}
                                            </td>
                                            <td class="text-center">{{ $user->address }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('admin#role#change', ['id' => $user->id]) }}">
                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top"
                                                            title="Role Change">
                                                            <i class="fa-solid fa-user-xmark"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach


                                </tbody>
                            </table>
                            {{ $customers->links() }}
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
