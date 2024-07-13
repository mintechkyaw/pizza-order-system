@extends('admin.layouts.master')

@section('title', 'Ordered Products List Page')

@section('order_focus')
    class="active has-sub"
@endsection

@section('searchbar')
    <div class="table-data__tool-left">
        <div class="overview-wrap">
            <h2 class="title-1">Ordered Info </h2>
        </div>
        <span class="text-danger">Included Delivery Charges</span>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">

                        <div class="table-data__tool-right">
                            <div class="overview-wrap">
                                <div class="row">
                                    <div class="col card mx-2   py-3 text-center " style="width: 18rem;">

                                        <h5 class="card-text"><i class="fa-solid fa-user me-2"></i> {{ $product[0]->name }}
                                        </h5>
                                    </div>
                                    <div class="col card mx-2   py-3 text-center " style="width: 18rem;">

                                        <h5 class="card-text"><i class="fa-solid fa-calendar me-2"></i> {{ $product[0]->order_date }}
                                        </h5>
                                    </div>

                                    <div class="col card mx-2  py-3 text-center" style="width: 18rem;">

                                        <h5 class="card-text"><i class="fa-solid fa-location-dot me-2"></i>
                                            {{ $product[0]->address }} </h5>
                                    </div>
                                    <div class="col card mx-2  py-3 text-center" style="width: 18rem;">

                                        <h5 class="card-text"><i class="fa-solid fa-money-bill-wave"></i>
                                            {{ $product[0]->final_price }} Kyats </h5>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                    @if ($product && $product->count() > 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center ">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>product price</th>
                                        <th>Quantity</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr class="tr-shadow">
                                            <td style="width: 13%; ">
                                                <img src="{{ asset('storage/' . $item->product_photo_path) }}"
                                                    alt="productphoto" />
                                            </td>

                                            <td>
                                                {{ $item->product_name }}
                                            </td>

                                            <td class="text-center">
                                                {{ $item->product_price }} Kyats
                                            </td>

                                            <td class="text-center">
                                                {{ $item->quantity }}
                                            </td>

                                            <td class="text-center"> <i class="zmdi zmdi-eye"></i>
                                                {{ $item->view_count }}
                                            </td>


                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <hr>
                            {{$product->links()}}
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
