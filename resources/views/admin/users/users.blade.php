@extends('layouts.dash-layout')

@section('content')
    <h4>Users List</h4>
    <hr>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th>Order</th>
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
@endsection