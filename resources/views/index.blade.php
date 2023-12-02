@extends('layouts.master')

@section('content')
    @if (request()->search)
        <div class="my-4 d-flex justify-content-between  w-50 p-2 rounded align-items-center shadow">
            <p class="fw-semibold mb-0"> Search results by <span class="text-info">{{ request()->search }}</span> </p>
            <a href="{{ route('page.index') }}" class="btn btn-sm ms-4 btn-light "> <i
                    class="bi bi-x-circle-fill text-danger fs-6"></i> Clear </a>
        </div>
    @endif

    @if (request()->category)
        <div class="my-4 d-flex justify-content-between  w-50 p-2 rounded align-items-center shadow">
            <p class="fw-semibold mb-0">Categorized by <span class="text-info">{{ request()->category }}</span> </p>
            <a href="{{ route('page.index') }}" class="btn btn-sm ms-4 btn-light "> <i
                    class="bi bi-x-circle-fill text-danger fs-6"></i> Clear </a>
        </div>
    @endif
    </div>
    <div class="row row-cols-5 gx-3 align-items-end ">
        @forelse ($products as $product)
            <div class="col mb-5">
                <a href="{{ route('page.sproduct', $product->id) }}" class="text-decoration-none">
                    <div class="card product-card" style="width: 80%; min-height: 280px">
                        <img style="height:160px" src="{{ asset('images/' . $product->img) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <p class="card-title"> {{ $product->name }} </p>
                            <div class="d-flex mb-1 flex-wrap ">
                                @if (!is_null($product->d_price))
                                    <p class="mb-0 price">${{ $product->d_price }} </p>
                                @endif
                                <p class="mb-0 {{ $product->d_price ? 'text-decoration-line-through  ms-2' : '' }} ">
                                    ${{ $product->price }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-danger fw-semibold text-center mx-auto">"Nothing Here"</p>
        @endforelse

        <div class="mb-5">
            {{ $products->links() }} 
        </div>
    </div>

@endsection
