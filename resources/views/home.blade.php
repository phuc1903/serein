<x-layouts.layout title="Home - Serein Jewelry">

    @include('article.banner')

    <x-list.product4 title="Sản phẩm mới" :products="$productNews"></x-list.product4>

    <x-list.product4 title="Sản phẩm bán chạy" :products="$productSellers"></x-list.product4>

    {{-- @include('products.product-favorite') --}}
    @include('posts.post-new')
    @include('article.coutdown')
    @include('article.form-register')
    @include('article.testimony')
    @include('article.evaluate')

</x-layouts.layout>
