@extends('user.layouts.master')

@section('title', 'pizza cart')

@section('order_focus', 'active')




@section('content')
    <!-- Order Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-9 table-responsive mb-5 mx-auto">
                @if ($order && $order->count() > 0)
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Products</th>
                            </tr>
                        </thead>

                        <tbody class="align-middle">
                            @foreach ($order as $item)
                                <tr>
                                    <td class="align-middle">{{ date('j-M-Y', strtotime($item->order_date)) }}</td>
                                    <td class="align-middle">{{ $item->order_code }} </td>
                                    <td class="align-middle">{{ $item->total_price }} Kyats </td>
                                    @if ($item->status == 'pending')
                                        <td class="align-middle text-muted"><i
                                                class="fa-solid fa-pizza-slice mx-2"></i>{{ $item->status }} </td>
                                    @elseif ($item->status == 'processing')
                                        <td class="align-middle text-warning"><i
                                                class="fa-solid fa-utensils mx-2"></i>{{ $item->status }} </td>
                                    @elseif ($item->status == 'delivered')
                                        <td class="align-middle text-success"><i class="fas fa-box text-success mx-2"></i>
                                            {{ $item->status }} </td>
                                    @elseif ($item->status == 'rejected')
                                        <td class="align-middle text-danger"><i
                                                class="fa-solid fa-thumbs-down mx-2"></i>{{ $item->status }} </td>
                                    @endif
                                    <td>
                                        <button class="btn btn-primary rounded">Ordered Products</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <hr>
                    {{ $order->links() }}
                @else
                    <p class="mt-3 h3 text-center ">No Data Found!</p>
                @endif
            </div>

        </div>
    </div>
    <!-- Order End -->
@endsection
