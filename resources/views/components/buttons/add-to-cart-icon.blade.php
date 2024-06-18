@props(['product_id'])

<form action="{{ route('cart.store', ['product_id' => $product_id])}}" method="post">
    @csrf
    <button class="btn-product btn-product-cart" type="submit">
        <i class="fa-solid fa-cart-shopping"></i>
    </button>
</form>