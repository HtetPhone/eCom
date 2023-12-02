@extends('layouts.dash-layout')

@section('content')
    <a href="{{route('users.list')}}" class="btn btn-dark btn-sm"> <i class="bi bi-house"></i> </a> <hr>

    <h5 class="mb-0">Edit <span class="text-primary"></span> </h5> <hr>
    <div class="w-75 pb-5">
        <form action="{{route('users.update', $user)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">User Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}">
                @error('name')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email', $user->email)}}">
                @error('email')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Role</label>
                <Select name="role" class="form-control">
                    <option value="">Select Role</option>
                    <option value="user" {{$user->role == 'user' ? 'selected' : '' }} >User</option>
                    <option value="admin" {{$user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </Select>
                @error('role')
                    <p class="text-danger"> {{$message}} </p>
                @enderror
            </div>
            <button class="btn btn-info">Update</button>
        </form>
    </div>
@endsection