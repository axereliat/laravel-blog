<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
    </a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/posts">Posts</a></li>
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/posts/create">Create Post</a></li>
        @can('create-category')
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/categories">Create Category</a></li>
        @endcan
        @can('manage-users')
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/admin/users">Manage Users</a></li>
        @endcan
        @auth
            <li class="c-header-nav-item px-3"><a href="/notifications" class="btn btn-primary">
                    Notifications <span class="badge bg-secondary">
                        {{ auth()->user()->notifications()->where('is_seen', 0)->count() }}
                    </span>
                </a></li>
        @endauth
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/items">Items</a></li>
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                <svg class="c-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg>
            </a></li>
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                <svg class="c-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                </svg>
            </a></li>
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                <svg class="c-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg>
            </a></li>
        <li class="c-header-nav-item dropdown">
            @auth
                @if(null !== auth()->user()->avatar)
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="c-avatar">
                            <img class="c-avatar-img"
                                 src="{{ asset(auth()->user()->avatar) }}"
                                 alt="{{ auth()->user()->name }}"
                            />
                        </div>
                    </a>
                @endif
            @endauth
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    Account
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3">

        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</header>