@extends('layouts.master')

@section('content')
    <div class="my-3">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="card p-3 shadow rounded d-flex flex-row mb-5">
        <div class="col-3">
            <img src="{{ asset('images/' . $product->img) }}" class="rounded w-75" style="height:300px" alt="">
        </div>
        <div class="col">
            <h1 class=" fw-lighter mb-0"> {{ $product->name }} </h1>
            <div class="my-2">
                @foreach ($product->categories as $category)
                    <a href="{{ route('categorize', ['category' => $category->name]) }}"
                        class="badge bg-primary text-decoration-none"> {{ $category->name }} </a>
                @endforeach
            </div>
            <p class="small text-secondary"> {{ $product->description }} </p>
            <div class="d-flex">
                @if (is_null($product->d_price))
                    <h4 class="price"> ${{ $product->price }} </h4>
                @else
                    <h4 class="price me-2"> ${{ $product->d_price }} </h4>
                    <h4 class="fw-light text-secondary text-decoration-line-through"> ${{ $product->price }} </h4>
                @endif
            </div>

            <p>
                <span>Quantity: </span>
            <form id="addToCartForm" method="POST" action="{{ route('to.cart', $product->id) }}">
                @csrf
                <span class="btn-group w-auto border border-2 ms-2">
                    <button id="minus" class="btn btn-dark"> <i class="bi-dash"></i> </button>
                    @csrf
                    <input type="text" value="1" id="quantity" readonly name="quantity" style="width:55px;outline:none"
                        class="ps-3 quantity" min="1" class="border-0">
                    <button id="plus" class="btn btn-dark"> <i class="bi-plus"></i> </button>
                </span>
            </form>
            @error('quantity')
                <p class="text-danger small"> {{ $message }} </p>
            @enderror
            </p>
            <div class="d-flex my-3 mt-4">
                <form action="{{route('buy.now',$product->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" id="bQuantity" value="1" min=1>
                    <button class="btn btn-outline-warning">Buy Now</button>
                </form>
                <button id="addToCart" class="btn btn-outline-info ms-2">Add to Cart</button>
            </div>
        </div>
    </div>

    @vite('/resources/js/addToCart.js')
@endsection
