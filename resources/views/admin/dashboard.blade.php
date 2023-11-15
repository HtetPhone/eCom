@extends('layouts.dash-layout')

@section('content')
    <h5>Dashboard</h5>
    <hr>
    <p> <span class="fw-semibold">Total Products</span> : <span class="price"> {{$products->count()}} {{Str::plural('product', $products->count())}} </span></p>

    <p> <span class="fw-semibold">Total Users</span> : <span class="price"> {{$users->count()}} {{Str::plural('user', $users->count())}} </span></p>

    <p> <span class="fw-semibold">Total Categories</span> : <span class="price"> {{$categories->count()}} {{Str::plural('category', $categories->count())}} </span></p>

    <p> <span class="fw-semibold">Total Orders</span> : <span class="price"> {{$orders->count()}} {{Str::plural('order', $orders->count())}} </span></p>
@endsection