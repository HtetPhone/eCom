@extends('layouts.master')

@section('content')
    <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>

    <h3>Your Orders</h3> <hr>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Qutantity</th>
                <th scope="col">Total</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Delivery Status</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $key => $order)
                <tr>
                    <td>
                        {{ $key + 1 }}
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
                        <form method="POST" action="{{ route('cancel.order', $order->id) }}">
                            @csrf
                            <button onclick="return confirm('Are u sure that u to cancel the order?')"
                                class="btn btn-danger">Cancel Order</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td class="text-center" colspan="8">
                        <p class="small text-danger text-center">No order Yet</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
