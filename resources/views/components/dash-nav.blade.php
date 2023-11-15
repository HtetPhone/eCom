<nav class="list-group">
    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action"> <i class="bi bi-speedometer2 text-dark"></i>     Dashboard</a>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed ps-3 py-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="bi bi-backpack-fill text-info me-1"></i> Products
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="{{ route('product.index') }}" class="btn text-start w-100">Products List</a>
                    <a href="{{ route('product.create') }}" class="btn text-start w-100">Create Product</a>
                </div>
            </div>
        </div>
    </div>

    <a href="{{route('category.list')}}" class="list-group-item list-group-item-action"> <i class="bi bi-bookmark-star-fill text-warning"></i> Categories</a>

    <a href="" class="list-group-item list-group-item-action"> <i class="bi bi-people-fill text-success"></i> Users</a>
</nav>
