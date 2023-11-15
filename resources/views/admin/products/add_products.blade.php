@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex justify-content-between align-items-end">
        <h5>Create Products Here</h5>
        <a title="products list" href="{{ route('product.index') }}" class="">
            <i class="bi bi-card-list fs-4 px-2 text-dark"> </i>
        </a>
    </div>
    <hr>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control" rows="4"> {{old('description')}} </textarea>
            @error('description')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Categories</label>
            <div class="d-flex">
                @foreach ($categories as $category)
                    <div class="me-3">
                        <input type="checkbox" name="categories[]" id="{{$category->id}}" value="{{$category->id}}"> 
                        <label class="fw-semibold" for="{{$category->id}}"> {{$category->name}} </label>
                    </div>
                @endforeach
            </div>
            @error('categories')
                <p class="small text-danger"> {{$message}} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Price</label>
            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
            @error('price')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Discount Price <span class="text-danger small">*Optional</span></label>
            <input type="number" class="form-control" name="d_price" value="{{ old('d_price') }}">
            @error('d_price')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">In Stock</label>
            <input type="number" class="form-control" name="in_stock" value="{{ old('in_stock') }}">
            @error('in_stock')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Image</label>
            <input type="file" class="form-control" name="img" value="{{ old('img') }}">
            @error('img')
                <p class="small text-danger"> {{ $message }} </p>
            @enderror
        </div>
        <div class="d-flex my-3 mb-5    ">
            <button class="btn btn-primary" type="submit">Create</button>
            <a href="{{route('product.index')}}" class="btn btn-dark ms-3">Cancle</a>
        </div>
    </form>
@endsection
