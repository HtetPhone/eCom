@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex align-items-center ">
        <h4>orders List</h4>
        <div class="ms-3">
            <form method="GET" action="{{ route('order.categorize') }}" class="d-flex align-items-center"
                onchange="this.submit()">
                <label for="" style="white-space: nowrap" class="me-2">Payment Status:</label>
                <select name="status" id="" class="form-select">
                    <option>Select Here</option>
                    <option value="status_p" {{ request()->status == 'status_p' ? 'selected' : '' }} >Paid</option>
                    <option value="status_c" {{ request()->status == 'status_c' ? 'selected' : '' }}>Cash on Delivery</option>
                </select>
            </form>
        </div>
        <div class="ms-auto">
            <form method="GET" action="{{ route('order.search') }}" class="input-group">
                <input type="search" name="key" id="" class="form-control" value="">
                <button class="btn btn-primary"> <i class="bi bi-search-heart"></i> </button>
            </form>
        </div>
    </div>
    <hr>
    <!-- if search -->
    @if (request()->key)
        <div class="my-4 d-flex justify-content-between  w-50 p-2 rounded align-items-center shadow">
            <p class="fw-semibold mb-0"> Search results by <span class="text-info">{{ request()->key }}</span> </p>
            <a href="{{ route('orders.list') }}" class="btn btn-sm ms-4 btn-light "> <i
                    class="bi bi-x-circle-fill text-danger fs-6"></i> Clear </a>
        </div>
    @endif

    <!-- if categorized -->
    @if (request()->status)
        <div class="my-4 d-flex justify-content-between  w-50 p-2 rounded align-items-center shadow">
            
            @if (request()->status == 'status_p')
                <p class="fw-semibold mb-0"> Categorized results by <span class="text-info"> Paid </span> </p>
            @else
                <p class="fw-semibold mb-0"> Categorized results by <span class="text-info"> Cash on Delivery </span> </p>
            @endif

            <a href="{{ route('orders.list') }}" class="btn btn-sm ms-4 btn-light "> <i
                    class="bi bi-x-circle-fill text-danger fs-6"></i> Clear </a>
        </div>
    @endif


    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qutantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Delivery Status</th>
                    <th>Option</th>
                    <th>Print PDF</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $key => $order)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $order->user->name }}
                        </td>
                        <td>
                            {{ $order->product->name }}
                        </td>
                        <td>
                            ${{ $order->price }}
                        </td>
                        <td>
                            {{ $order->quantity }}
                        </td>
                        <td>
                            ${{ $order->total }}
                        </td>
                        <td>
                            {{ $order->payment_status }}
                        </td>
                        <td>
                            {{ $order->delivery_status }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('order.deliever', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <button onclick="return confirm('Are u sure that u have delivered?')"
                                    class="btn {{ $order->delivery_status == 'Delivered' ? 'btn-outline-secondary' : 'btn-info' }}"
                                    {{ $order->delivery_status == 'Delivered' ? 'disabled' : '' }}>Deliver</button>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('print.order', $order) }}" class="btn btn-outline-success">Print PDF</a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="text-center" colspan="9">
                            <p class="small text-danger text-center">No order Yet</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
