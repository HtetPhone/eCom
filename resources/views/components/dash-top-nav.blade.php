<div class="col-12 mx-auto d-flex justify-content-between shadow py-2 px-3 mb-3">
    <h5 class="p-2">
        <a class="text-decoration-none" href="{{route('dashboard')}}">eCom Panel</a>
    </h5>
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li> <a href="{{route('page.index')}}" class="dropdown-item">Go to Front Page</a> </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
