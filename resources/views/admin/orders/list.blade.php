@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('order_focus')
    class="active has-sub"
@endsection

@section('searchbar')
    <form class="form-header" action="{{ route('admin#orders#search') }}" method="GET">
        <input class="au-input au-input--xl" type="text" name="searchKey"
            value="@if (isset($searchKey)) {{ $searchKey }} @endif" placeholder="Search for orders.." />

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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <form class="table-data__tool-right" action="{{ route('admin#orders#list') }}">
                            <select name="filterStatus" class="au-btn au-btn-icon au-btn--green au-btn--small px-4 py-2">
                                <option class="bg-dark" value="">All</option>
                                <option class="bg-info" @selected(request('filterStatus') == 'pending') value="pending">Pending</option>
                                <option class="bg-warning" @selected(request('filterStatus') == 'processing') value="processing">Processing
                                </option>
                                <option class="bg-success" @selected(request('filterStatus') == 'delivered') value="delivered">Delivered</option>
                                <option class="bg-danger" @selected(request('filterStatus') == 'rejected') value="rejected">Rejected</option>
                            </select>

                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                Apply Filter
                            </button>
                        </form>
                    </div>


                    <div class="msg">

                    </div>


                    @if ($orders && $orders->count() > 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="order-data">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <input type="hidden" id="orderId" value="{{ $order->order_id }}">
                                            <td>{{ $order->user_id }} </td>
                                            <td>{{ $order->name }} </td>
                                            <td>{{ date('j-M-Y', strtotime($order->order_date)) }}</td>
                                            <td><a
                                                    href="{{ route('admin#order#list', ['ordercode' => $order->order_code]) }}">{{ $order->order_code }}
                                                </a></td>
                                            <td>{{ $order->total_price }} Kyats </td>

                                            <td>
                                                <select class='form-select' name="" id="orderstatus">
                                                    <option @selected($order->status == 'pending') value="pending">Pending</option>
                                                    <option @selected($order->status == 'processing') value="processing">Processing
                                                    </option>
                                                    <option @selected($order->status == 'delivered') value="delivered">Delivered
                                                    </option>
                                                    <option @selected($order->status == 'rejected') value="rejected">Rejected</option>
                                                </select>

                                            </td>
                                            <td>
                                                <button class="btn btn-primary confirm" id="confirm">Confirm</button>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <hr>
                            {{ $orders->links() }}
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

@push('script')
    <script>
        $(document).ready(function() {
            $('.confirm').click(function() {
                $parentNode = $(this).parents('tr');
                $status = $parentNode.find('#orderstatus').val();
                $orderid = $parentNode.find('#orderId').val();
                console.log($status);
                console.log($orderid);
                $.ajax({
                    url: 'http://127.0.0.1:8000/admin/orderstatus',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        'status': $status,
                        'orderid': $orderid
                    },
                    success: function(response) {
                        if (response.msg == 'Order Pending Success!') {
                            $data = `<div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong > ${response.msg} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`
                        } else if (response.msg == 'Order Processing Success!') {
                            $data = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong > ${response.msg} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`
                        } else if (response.msg == 'Order Delivering Success!') {
                            $data = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong > ${response.msg} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`
                        } else if (response.msg == 'Order Rejecting Success!') {
                            $data = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong > ${response.msg} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>`
                        }
                        $('.msg').html($data)
                    }

                })
            })

            // $('#filter-status').change(function() {
            //     $fliterStatus = $(this).val()
            //     $.ajax({
            //         url: 'http://127.0.0.1:8000/admin/orderfilter',
            //         type: 'get',
            //         data: {
            //             'filter': $fliterStatus
            //         },
            //         success: function(response) {
            //             var $list;
            //             if (response.length == 0) {
            //                 $list = `<tr>No Data Found!</tr>`
            //             } else {
            //                 $.each(response, function(index, order) {
            //                         $list += `<tr>
        //                                 <input type="hidden" id="orderId" value=" ${order.order_id} ">
        //                                 <td> ${order.user_id}  </td>
        //                                 <td> ${order.name}  </td>
        //                                 <td> ${order.order_date} </td>
        //                                 <td> ${order.order_code}  </td>
        //                                 <td> ${order.total_price}  Kyats </td>

        //                                 <td>
        //                                     <select class="form-select" name="" id="orderstatus">
        //                                         <option value="pending" ${order.status == 'pending' ? 'selected' : ''}>Pending</option>
        //                                         <option value="processing" ${order.status == 'processing' ? 'selected' : ''}>Processing</option>
        //                                         <option value="delivered" ${order.status == 'delivered' ? 'selected' : ''}>Delivered</option>
        //                                         <option value="rejected" ${order.status == 'rejected' ? 'selected' : ''}>Rejected</option>
        //                                     </select>
        //                                 </td>
        //                                 <td>
        //                                     <button class="btn btn-primary confirm" id="confirm">Confirm</button>
        //                                 </td>
        //                             </tr>
        //                             <tr class="spacer"></tr>`;
            //                     }


            //                 )
            //             };
            //             $('#order-data').html($list);
            //         }
            //     })
            // })
        })
    </script>
@endpush
