@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex">
        <h4>Users List</h4>
        <div class="ms-auto">
            <a href="{{route('users.create')}}" class="btn btn-outline-dark">
                <i class="bi bi-plus-circle"></i> Add More User
            </a>
        </div>
    </div>
    <hr>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th>Order</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $key => $user)
                <tr>
                    <td>
                        {{$key + 1 }}
                    </td>
                   <td>
                        <p class="mb-0"> {{$user->name}} </p>
                        <p class="small text-secondary"> {{$user->email}} </p>
                   </td>
                   <td>
                        {{$user->role}}
                   </td>
                   <td>
                        {{$user->orders->count()}} {{Str::plural('order', $user->orders->count())}}
                   </td>

                   <td>
                        <div class="btn-group">
                            <a href="{{route('users.edit', $user)}}" class="btn btn-sm btn-info">Edit</a>
                            <button onclick="return confirm('are u sure to remove this user');" form="removeUser{{$user->id}}" class="btn btn-sm btn-danger">Remove</button>
                        </div>
                        <form method="post" action="{{route('users.remove', $user->id)}}" id="removeUser{{$user->id}}">
                            @csrf
                            @method('delete')
                        </form>
                   </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="3">
                        <p class="small text-danger text-center">No user Yet</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $users->links() }}
    </div>
@endsection