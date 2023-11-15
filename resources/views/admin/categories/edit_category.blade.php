@extends('layouts.dash-layout')

@section('content')
    <h2 class="mb-0">Edit Categories</h2>
    <hr>
    <form method="POST" action="{{ route('category.edit', $category->id) }}" class="mb-4">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label for="">Category Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
            @error('name')
                <p class="text-danger small"> {{ $message }} </p>
            @enderror
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-success">Update</button>

            <a href="{{route('category.list')}}" class="btn btn-light border ms-3">Cancle</a>

        </div>
    </form>
@endsection
