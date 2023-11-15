@if (session()->has('message'))
    <div class="alert alert-dark alert-dismissible fade show my-alert w-50 text-center" id='flash-message' role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
