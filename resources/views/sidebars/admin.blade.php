<div class="col l-3">
    <div class="header__admin">
        {{-- <a class="header__admin-item active" href="info.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Hồ sơ</span></a>
        <a class="header__admin-item " href="your_orders.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Đơn hàng của bạn</span></a>
        <a class="header__admin-item " href="{{ route('admin.category.list') }}"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý danh muc</span></a>
        <a class="header__admin-item " href="{{ route('admin.product.list') }}"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý sản phẩm</span></a>
        <a class="header__admin-item " href="admin/manager_comments.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý bình luận</span></a>
        <a class="header__admin-item " href="admin/manager_users.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý tài khoản khách hàng</span></a>
        <a class="header__admin-item " href="admin/manager_orders.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content" id="managerOrder">Quản lý đơn hàng</span></a>
        <a class="header__admin-item " href="{{ route('admin.banner.list') }}"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý banners</span></a>
        <a class="header__admin-item " href="{{ route('admin.voucher.list') }}"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Quản lý vouchers</span></a>
        <a class="header__admin-item " href="admin/index.html"><p class="header__admin-item-icon"></p><span class="heeader__admin-item-content">Dashboard</span></a> --}}
        @if (Auth::check() && Auth::user()->role == 1)

            <x-links.sidebar-admin href="{{ route('admin.dashboard') }}" :active="request()->is('admin')">
                Dashboard
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('admin.product.list') }}" :active="request()->is('admin/product*')">
                Quản lí sản phẩm
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('admin.category.list') }}" :active="request()->is('admin/category*')">
                Quản lí danh mục
            </x-links.sidebar-admin>

            {{-- <x-links.sidebar-admin href="{{ route('admin.banner.list') }}" :active="request()->is('admin/banner*')">
                Quản lí banner
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('admin.voucher.list') }}" :active="request()->is('admin/voucher*')">
                Quản lí voucher
            </x-links.sidebar-admin> --}}

            <x-links.sidebar-admin href="{{ route('admin.order.list') }}" :active="request()->is('admin/order*')">
                Quản lí đơn hàng
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('admin.user.list') }}" :active="request()->is('admin/user*')">
                Quản lý user
            </x-links.sidebar-admin>
        @endif

        @auth
            <x-links.sidebar-admin href="{{ route('order.index') }}" :active="request()->is('order*')">
                Lịch sử mua hàng
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('info') }}" :active="request()->is('info*')">
                Hồ sơ
            </x-links.sidebar-admin>

            <x-links.sidebar-admin href="{{ route('favorite', Auth::user()) }}" :active="request()->is('favorite*')">
                Danh sách sản phẩm yêu thích
            </x-links.sidebar-admin>
        @endauth


    </div>
</div>