@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex align-items-end">
        <h5 class="mb-0">Edit Product Here</h5>
        <div class="ms-auto">
            <a href="{{route('product.index')}}" class="btn btn-sm btn-outline-dark">
                <i class="bi bi-house"></i>
            </a>
        </div>
    </div>
    <hr>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" rows="4" class="form-control"> {{old('description', $product->description)}} </textarea>
            @error('description')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Categories</label>
            <div class="d-flex">
                @foreach ($categories as $category)
                    <div class="me-3">
                        <input type="checkbox" name="categories[]" id="{{$category->id}}" value="{{$category->id}}" {{ $product->categories->contains('id', $category->id) ? 'checked': ''}}> 
                        <label class="fw-semibold" for="{{$category->id}}"> {{$category->name}} </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="">Price</label>
            <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Discount Price <span class="text-danger small">*Optional</span></label>
            <input type="number" class="form-control" name="d_price" value="{{ old('d_price', $product->d_price) }}">
            @error('d_price')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">In Stock</label>
            <input type="number" class="form-control" name="in_stock" value="{{ old('in_stock', $product->in_stock) }}">
            @error('in_stock')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Image</label>
            <div class="w-50 my-2">
                <img src="{{asset('images/'. $product->img)}}" alt="" class="w-25">
            </div>
            <input type="file" class="form-control" name="img" value="{{ old('img') }}">
            @error('img')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="d-flex my-3 mb-5    ">
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{route('product.index')}}" class="btn btn-outline-dark ms-3">Go Back</a>
        </div>
    </form>
@endsection
