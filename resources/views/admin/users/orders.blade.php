@extends('layouts.dash-layout')

@section('content')
    <h4>orders List</h4>
    <hr>

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
                                <button onclick="return confirm('Are u sure that u have delivered?')" class="btn {{ $order->delivery_status == "Delivered" ? 'btn-outline-secondary' : 'btn-info'}}" {{ $order->delivery_status == "Delivered" ? 'disabled' : '' }}>Deliver</button>
                            </form>
                        </td>

                        <td>
                            <a href="{{route('print.order', $order)}}" class="btn btn-outline-success">Print PDF</a>
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
    </div>
@endsection
