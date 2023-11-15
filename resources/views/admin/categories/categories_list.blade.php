@extends('layouts.dash-layout')

@section('content')
    @include('admin.categories.add_category')

    <div class="d-flex justify-content-between align-items-center mt-5">
        <h2>Categories List</h2>
        
    </div>
    <hr>
    <table class="table table-striped table-hover mb-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th width="18%" scope="col">Name</th>
                <th scope="col">Handle</th>
                <th width='15%' scope="col">Created_at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key => $category)
                <tr>
                    <td> {{ $key + 1 }} </td>
                    <td>
                       {{ $category->name }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('category.edit', $category->id)}}" class="btn btn-sm btn-outline-dark">Edit</a>
                            <button form="deleteCategory{{$category->id}}" class="btn btn-sm btn-outline-dark" onclick="return confirm('Are u sure to delete?')">Delete</button>
                        </div>
                        <form method="POST" action="{{route('category.destroy', $category->id)}}" id="deleteCategory{{$category->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    <td>
                        {{ $category->created_at->diffForHumans() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">
                        <p class="small text-danger text-center">No category Yet</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
