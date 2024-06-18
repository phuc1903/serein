<x-layouts.layout title="Shop Serein Jewelry">

    <section class="products-sidebar container">
        <div class="grid wide">
            <div class="row">
                @include('sidebars.shop')
                {{-- @include('products.product-shop') --}}

                <x-list.product3 :products="$products" totalProducts="{{ $totalProducts }}">

                    <x-links.pagination :data="$products" />

                </x-list.product3>
            </div>
        </div>
    </section>

    @include('article.form-register')
    @include('article.evaluate')

</x-layouts.layout>
