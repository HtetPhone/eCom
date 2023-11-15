@extends('layouts.dash-layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Products List</h2>
        <a title="add product" href="{{ route('product.create') }}">
            <i class="bi bi-plus-circle fs-4 px-2 text-dark"></i>
        </a>
    </div>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th width="18%" scope="col">Name</th>
                <th scope="col">Price</th>
                <th width="15%" scope="col">Image</th>
                <th> Categories</th>
                <th>In Stock</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $key => $product)
                <tr>
                    <td> {{ $key + 1 }} </td>
                    <td>
                        <p class="mb-0">{{ $product->name }}</p>
                        <p class="small text-black-50">{{ Str::limit($product->description, 28, '...') }}</p>
                    </td>
                    <td>
                        @if (is_null($product->d_price))
                            <p class="price">${{$product->price}} </p>
                        @else
                            <p class="price mb-0"> ${{ $product->d_price }} </p>
                            <p class="text-decoration-line-through"> $ {{$product->price}}  </p>
                        @endif
                    </td>
                    <td> <img src="{{ asset('images/' . $product->img) }}" style="height: 80px;width:80px;" alt=""> </td>
                    <td> 
                        @forelse ($product->categories as $cat)
                            {{$cat->name}} |
                        @empty
                            
                        @endforelse    
                    </td>
                    <td> {{$product->in_stock}} Items </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-sm btn-outline-dark">Edit</a>
                            <a href="{{route('product.show', $product)}}" class="btn btn-sm btn-outline-dark">Detail</a>
                            <button form="deleteProduct{{$product->id}}" class="btn btn-sm btn-outline-dark" onclick="return confirm('Are u sure to delete?')">Delete</button>
                        </div>
                        <form method="POST" action="{{route('product.destroy', $product->id)}}" id="deleteProduct{{$product->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">
                        <p class="small text-danger text-center">No Product Yet</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
