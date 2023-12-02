@extends('layouts.dash-layout')

@section('content')
    <a href="{{route('users.list')}}" class="btn btn-dark btn-sm"> <i class="bi bi-arrow-left"></i> </a> <hr>

    <h5 class="mb-0">Create a New User</h5> <hr>
    <div class="w-75 pb-5">
        <form action="{{route('users.create')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">User Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                @error('name')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}">
                @error('email')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Role</label>
                <Select name="role" class="form-control">
                    <option value="">Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </Select>
                @error('role')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <button class="btn btn-info">Create</button>
        </form>
    </div>
@endsection