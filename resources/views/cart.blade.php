@php
    $title = 'Giỏ hàng của bạn';

    if (Auth::user()) {
        $title = 'Giỏ hàng của ' . Auth::user()->name;
    }
@endphp

<x-layouts.layout title="{{ $title }}">

    <div class="summary container cart">
        <div class="grid wide">
            <div class="row">
                <div class="col l-8 cart__list__product">
                    @if ($products != null)
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($products as $product)
                            <div class="product__item" data-product-id="{{ $product['product_id'] }}">
                                <!-- img -->
                                <div class="product__item__img">
                                    @if (Str::contains($product['image'], 'product_images'))
                                        <img src="{{ asset('storage/' . $product['image']) }}">
                                    @else
                                        <img src="{{ asset('img/' . $product['image']) }}">
                                    @endif
                                </div>
                                <div class="product__item-right">
                                    <div class="product__item__infomation">
                                        <!-- information  -->
                                        <div class="information__name">
                                            <div class="name line-champ-1">{{ $product['title'] }}</div>
                                        </div>

                                        <div class="information__choice">
                                            <a data-route="{{ route('cart.destroy', $product['product_id']) }}"
                                                class="information__choice-btn choice__remove">Xóa</a>
                                                <form action="{{ route('favorite-store', ['product_id' => $product['product_id']]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="information__choice-btn choice__like">Yêu thích</button>
                                                </form>
                                        </div>
                                    </div>
                                    <!-- price and quantity -->
                                    <div class="information__quantity">
                                        <div class="choice__price">
                                            @php
                                                $totalPriceProduct = $product['price'] * $product['quantity'];
                                            @endphp
                                            <div class="price__value">{{ number_format($totalPriceProduct) }}</div>
                                            <div class="price__usa">VNĐ </div>
                                        </div>
                                        <!-- quantity -->
                                        <div class="detailquantity__quantity__updown">
                                            <div class="quantity__minus detail-pre pre-quantity">-</div>
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <input name="quantity" type="text" value="{{ $product['quantity'] }}"
                                                data-route="{{ route('cart.updateQuantity') }}"
                                                class="quantity__value product_quantity quantity-input"
                                                style="text-align: center;">
                                            </input>
                                            <div class="quantity__add detail-add add-quantity">+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $totalPrice += $totalPriceProduct;
                            @endphp
                        @endforeach
                    @else
                        <h1>Giỏ hàng rỗng</h1>
                    @endif
                    <h1 class="cart-null"></h1>
                </div>
                <div class="col l-4 cart__pay">
                    <div class="cart__pay__box">
                        <div class="pay__voucher">
                            <label for="" class="text__voucher">Nhập mã giảm giá</label>
                            <div class="value__voucher">
                                <input type="text" placeholder="Add coupon">
                                <button type="button">Apply</button>
                            </div>
                        </div>
                        <div class="totalprice">
                            <div class="cart__pay__price">
                                <div class="product__price">
                                    <label for="" class="text">Tổng giá sản phẩm</label>
                                    <div class="box__price">
                                        @php
                                            $totalPrice = 0;
                                            if ($products != null) {
                                                foreach ($products as $product) {
                                                    $totalPriceProduct =
                                                        ($product['price'] ?? 0) * $product['quantity'];
                                                    $totalPrice += $totalPriceProduct;
                                                }
                                            }
                                        @endphp
                                        <div class="price">{{ number_format($totalPrice, 0, ',', '.') }}</div>
                                        <div class="usas">VNĐ</div>
                                    </div>
                                </div>
                                <!-- ship -->
                                <div class="product__price">
                                    <label for="" class="text">Phí giao hàng</label>
                                    <div class="box__price">
                                        <div class="price_ship">18.000</div>
                                        <div class="usas">VNĐ</div>
                                    </div>
                                </div>
                                <hr class="hr__pay">
                                <div class="product__price">
                                    <label for="" class="text text--bold">Tổng tiền</label>
                                    <div class="box__price">
                                        <div class="price-total text--bold">
                                            {{ number_format($totalPrice + 18000, 0, ',', '.') }}</div>
                                        <div class="usas">VNĐ</div>
                                    </div>
                                </div>
                                <!-- button thanh toan -->
                                @if ($products != null)
                                    <form action="{{ route('order.store') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn__pay"><a>Thanh toán ship Cod</a></button>
                                    </form>
                                @endif
                                <form action="{{ route('momo_payment') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn__pay" name="payUrl"><a>Thanh toán momo</a></button>
                                </form>
                                <div class="link">
                                    <img src="img/post1.png" alt="">
                                    <img src="img/post1.png" alt="">
                                    <img src="img/post1.png" alt="">
                                    <img src="img/post1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.layout>
