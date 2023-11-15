@extends('layouts.master')

@section('content')
    <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('page.index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>

    <h3>Checkout Your Products</h3>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" width="20%">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carts as $key => $cart)
                <tr>
                    <td> {{ $key + 1 }} </td>
                    <td>
                        <img src="{{ asset('images/' . $cart->product->img) }}" width="40px" height="40px" alt="">
                        <p> {{ $cart->product->name }} </p>
                    </td>
                    <td>
                        <p class="fw-semibold price">
                            ${{ $cart->product->d_price ?? $cart->product->price }}
                        </p>
                    </td>
                    <td>
                        <p class="fw-semibold price"> {{ $cart->quantity }} </p>
                    </td>
                    <td>
                        <p class="fw-semibold price t-price">
                            ${{ $cart->product->d_price ? $cart->product->d_price * $cart->quantity : $cart->product->price * $cart->quantity }}
                        </p>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('remove.cart', $cart->id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are u sure to remove this item?')"
                                class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"><p class="small text-center text-danger my-4"> Nothing is in the cart </p></td>
                </tr>
            @endforelse
            <tr class="table-primary">
                <td></td>
                <td colspan="3"><span class="fw-bolder fs-5">Total Amount</span></td>
                <td colspan="3"> <p id="tAmount" class="fw-bolder fs-5 price">  </p>  </td>
            </tr>
        </tbody>
    </table>
    <h3 class="text-center mt-4">Proceed to Order</h3>
    <div class="mb-5 d-flex justify-content-center">
        <form action="{{route('clear.cart')}}" method="GET">
            <button onclick="return confirm('Are u sure to clear the cart?')" class="btn btn-outline-danger"> <i class="bi bi-x-circle-fill"></i> Clear the Cart</button>
        </form>
        <a href="{{route('cash.on')}}" class="btn btn-outline-success ms-3"> <i class="bi bi-truck"></i> Cash on Delivery</a>
        <form method="GET" action="{{route('with.card')}}">
            <input type="hidden" name="total_amount" value="" id="tInput">
            <button class="btn btn-outline-info ms-3"> <i class="bi bi-credit-card-fill"></i> Pay with Card</button>
        </form>
    </div>
    <div class="my-5 p-4"></div>
    @vite('resources/js/totalPrice.js')
@endsection
