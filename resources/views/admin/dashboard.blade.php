@extends('layouts.dash-layout')

@section('content')
    <h5>Dashboard</h5>
    <hr>

    <div class="row mb-5">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card card-body d-flex flex-row justify-content-between align-items-start shadow ">
                <div>
                    <p class="mt-2 price fw-bold ">Total Products</p>
                    <p  class="price fw-semibold mb-0">{{$products->count()}} {{Str::plural('product', $products->count())}} </p>
                </div>
                <div>
                    <i class="bi bi-luggage-fill text-primary mt-0" style="font-size:30px"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <div class="card card-body d-flex flex-row justify-content-between align-items-start shadow ">
                <div>
                    <p class="mt-2 price fw-bold ">Total Users</p>
                    <p  class="price fw-semibold mb-0">{{$users->count()}} {{Str::plural('user', $users->count())}} </p>
                </div>
                <div>
                    <i class="bi bi-people-fill text-success mt-0" style="font-size:28px"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <div class="card card-body d-flex flex-row justify-content-between align-items-start shadow ">
                <div>
                    <p class="mt-2 price fw-bold ">Total Categories</p>
                    <p  class="price fw-semibold mb-0"> {{$categories->count()}} {{Str::plural('category', $categories->count())}} </p>
                </div>
                <div>
                    <i class="bi bi-bookmark-star-fill text-warning mt-0" style="font-size:28px"></i>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card card-body d-flex flex-row justify-content-between align-items-start shadow ">
                <div>
                    <p class="mt-2 price fw-bold ">Total Orders</p>
                    <p  class="price fw-semibold mb-0"> {{$orders->count()}} {{Str::plural('order', $orders->count())}} </p>
                </div>
                <div>
                    <i class="bi bi-stack text-danger mt-0" style="font-size:28px"></i>
                </div>
            </div>
        </div>
    </div>
@endsection