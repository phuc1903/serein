<header>
    <div class="grid wide">
        <div class="header__main">
            <div class="logo">
                <img src="{{ asset('img/logo3.png') }}" alt="">
            </div>
            <div class="nav">

                <x-layouts.navbar/>

                <div class="right__icons">
                    {{-- <div class="right__icon-item">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div> --}}
                    <div class="right__icon-item">
                        @auth
                            @if (Str::contains(Auth::user()->avatar, 'user_images'))
                                <img src="{{ asset('storage/'. Auth::user()->avatar) }}" alt="">
                            @else
                                <img src="{{ asset('img/default.jpg') }}" alt="">
                            @endif
                        @endauth
                        @guest
                            <i class="fa-solid fa-user"></i>
                        @endguest
                        <div class="right_icon-chirld">
                            @if (Auth::check() && Auth::user()->role == 1)
                                <a href="{{ route('admin.dashboard') }}"><div class="right_icon-chirld-item">Admin</div></a>
                            @endif
                            @auth
                                <a href="{{ route('info') }}"><div class="right_icon-chirld-item">Hồ sơ</div></a>
                                <a href="{{ route('favorite', Auth::user()) }}"><div class="right_icon-chirld-item">Sản phẩm yêu thích</div></a>
                                <a href="{{ route('order.index') }}"><div class="right_icon-chirld-item">Lịch sử mua hàng</div></a>
                                <a href="{{ route('password.request') }}"><div class="right_icon-chirld-item">Quên mật khẩu</div></a>
                                <a href="{{ route('logout') }}"><div class="right_icon-chirld-item">Đăng xuất</div></a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}"><div class="right_icon-chirld-item">Đăng nhập</div></a>
                                <a href="{{ route('register') }}"><div class="right_icon-chirld-item">Đăng ký</div></a>
                            @endguest
                        </div>
                    </div>
                    <div class="right__icon-item">
                        <a href="{{ route('cart.index') }}" class="right__icon"><i class="fa-solid fa-cart-shopping"></i></a>
                        @php
                            $carts = session()->get('carts', []);
                            $totalQuantity = 0;
                            foreach ($carts as $item) {
                                $totalQuantity += $item['quantity'];
                            }
                        @endphp
                        <span class="totalQuantityCart">({{ $totalQuantity }})</span>
                    </div>
                    <div class="right__icon-item">
                        <a href="{{ route('favorite')}}" class="right__icon"><i class="fa-regular fa-heart"></i></a>
                        <span class="totalQuantityFavorite">({{ session()->get('totalFavorites', 0) }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
