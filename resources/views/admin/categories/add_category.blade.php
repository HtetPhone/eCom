<div>
    <h2 class="mb-0">Add Categories</h2>
    <hr>
    <form method="POST" action="{{ route('category.store') }}" class="mb-4">
        @csrf
        <div class="mb-2">
            <label for="">Category Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
            @error('name')
                <p class="text-danger small"> {{$message}} </p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
