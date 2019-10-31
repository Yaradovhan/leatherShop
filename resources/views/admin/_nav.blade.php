<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    @can ('manage-products')
        <li class="nav-item"><a class="nav-link{{ $page === 'products' ? ' active' : '' }}"
                                href="{{ route('admin.products.products.index') }}">Products</a></li>
    @endcan
    @can ('manage-products-categories')
        <li class="nav-item"><a class="nav-link{{ $page === 'products_categories' ? ' active' : '' }}"
                                href="{{ route('admin.products.categories.index') }}">Categories</a></li>
    @endcan
        @can ('manage-pages')
            <li class="nav-item"><a class="nav-link{{ $page === 'pages' ? ' active' : '' }}" href="{{ route('admin.pages.index') }}">Pages</a></li>
        @endcan
    @can ('manage-users')
        <li class="nav-item"><a class="nav-link{{ $page === 'users' ? ' active' : '' }}"
                                href="{{ route('admin.users.index') }}">Users</a></li>
    @endcan
</ul>
