<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route('dashboard') }}" class="brand-wrap">
            @if ($config)
                {{-- <link rel="shortcut icon" href="" type="image/x-icon"> --}}
                <img src="{{ asset('files/config/'.$config->logo) }}" class="logo" alt="Evara Dashboard">
            @endif
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i>
            </button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item active">
                <a class="menu-link" href="{{ route('dashboard') }}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ route('employee.index') }}"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">Employee</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Category</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('category.index') }}">Category List</a>
                    <a href="{{ route('category.create') }}">Create Category</a>
                </div>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Banner</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('banner.index') }}">Banner List</a>
                    <a href="{{ route('banner.create') }}">Create Banner</a>
                </div>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-store"></i>
                    <span class="text">Campaign</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('campaign.index') }}">Campaign List</a>
                    <a href="{{ route('campaign.create') }}">Create Campaign</a>
                </div>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-store"></i>
                    <span class="text">Service</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('variation.index') }}">Service List</a>
                    <a href="{{ route('variation.create') }}">Create Service</a>
                </div>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">product</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('product.index') }}">Product List</a>
                    <a href="{{ route('product.create') }}">Add product</a>
                </div>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">Coupon</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('coupon.index') }}">Coupon List</a>
                    <a href="{{ route('coupon.create') }}">Add coupon</a>
                </div>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ route('admin.order') }}"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">Order</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{ route('shipping.index') }}"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">Shipping</span>
                </a>
            </li>
            @if (Auth::guard('admin')->user()->role == 'superAdmin')
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-add_box"></i>
                        <span class="text">Configuration</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('config.index') }}">Site Setting</a>
                        <a href="{{ route('customlink.index') }}">Custom Code</a>
                    </div>
                </li>
            @endif
        </ul>
        <br>
        <br>
    </nav>
</aside>
