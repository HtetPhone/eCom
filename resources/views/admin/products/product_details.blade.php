@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex align-items-center ">
        <h5 class="fw-light me-auto">Product Details</h5>
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-dark">
                <i class="bi bi-house-x"></i>
            </a>
            <a href="{{ route('product.create') }}">
                <i class="bi bi-plus btn btn-sm btn-outline-dark rounded-circle ms-2"></i>
            </a>
        </div>
    </div>
    <hr>
    <div class="text-center w-50 mx-auto my-3">
        <img src="{{asset('images/'.$product->img)}}" alt="" class="w-50">
    </div>
    <p>Product Name : <span class="price">{{ $product->name }}</span> </p>
    <p>Product description : <span class="price"> {{ $product->description }}</span> </p>
    
    @if ($product->categories)
    <p>
        Product Categories : @foreach ($product->categories as $cat)
        <span class="price"> {{$cat->name}} </span> |
    @endforeach </p>
    @endif

    <p>Product price : <span class="price">${{ $product->price }}</span> </p>
    @if (!is_null($product->d_price))
        <p>Product Discount Price: <span class="price">${{ $product->d_price }}</span> </p>
    @endif
    <p>In Stock : <span class="price">{{ $product->in_stock }}items</span> </p>
    <a href="{{route('product.index')}}" class="btn btn-outline-dark mb-4">Go Back</a>
@endsection
