<x-layouts.layout title="{{ $product->title }}">

    <div class="summary container">
        <div class="grid wide summary__box">
            <div class="row">
                <div class="col l-6 summary-images">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="" class="img-main"
                        onclick="handleThumbnailClick(event)">
                    {{-- <div class="listimg listimg-sizes">
                        <img src="asset/img/bong-tai-bac-3.png" alt="" class="thumbnails-item"
                            onclick="changeImage(this)">
                        <img src="asset/img/bong-tai-bac.png" alt="" class="thumbnails-item"
                            onclick="changeImage(this)">
                        <img src="asset/img/bong-tai-bac-2.png" alt="" class="thumbnails-item"
                            onclick="changeImage(this)">
                        <img src="asset/img/bong-tai-bac-3.png" alt="" class="thumbnails-item"
                            onclick="changeImage(this)">
                    </div> --}}
                </div>

                <div class="col l-6 summary-content">
                    <div class="summary-content-name "> {{ $product->title }}
                        <div class="summary-content-vote">
                            5.0
                        </div>
                    </div>

                    <div class="summary-content-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
                    <div class="summary-content-desciption">
                        {{ $product->description }}
                    </div>
                    <div class="summary-content-sizes">
                        <span class="summary-content-size">
                            <span>size</span>
                            <div>
                                <p>X</p>
                                <p>L</p>
                                <p>M</p>
                            </div>
                        </span>
                    </div>
                    <form action="{{ route('cart.store', ['product_id' => $product->id] ) }}" class="detailquantity" method="post">
                        @csrf
                        <div class="detailquantity__quantity">
                            <!-- <p class="detailquantity__quantity-text">2 in stock</p> -->
                            <div class="detailquantity__quantity__updown">
                                <div class="quantity__minus detail-pre pre-quantity">-</div>
                                <input 
                                    name="quantity"
                                    type="text" value="1"
                                    min="1"
                                    class="quantity__value product_quantity quantity-input" 
                                    style="text-align: center;"
                                    >
                                </input>
                                <div class="quantity__add detail-add add-quantity">+</div>
                            </div>

                        </div>
                        <div class="detailquantity__cart">
                            <a href="">
                                <button type="button" class="detailquantity__buy">Mua ngay</button>
                            </a>
                            {{-- <a id="add-cart"> --}}
                            <button type="submit" class="detailquantity__addtocart add-cart">Thêm giỏ hàng</button>
                            {{-- </a> --}}
                        </div>
                        <div class="Category">
                            Category:
                            <div class="detail__Category">
                                <div class="detail__Category__type">Nhẫn, Nhẫn Bạc</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-list.product4 title="Sản phẩm liên quan" :products="$relatedProduct"></x-list.product4>
    </div>

</x-layouts.layout>
