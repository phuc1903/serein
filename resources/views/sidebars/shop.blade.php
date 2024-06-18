<div class="col l-3 sidebar">
    <div class="header__admin">
        <form action="{{ route('search.product')}}" method="get" class="form-search-sidebar" style="margin-bottom: 24px">
            <input type="text" placeholder="Tìm kiếm" name="key">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        @foreach ($categories as $cate)
        <x-links.categories-shop href="{{ route('shop.category', $cate) }}" :active="request()->is('shop/'.$cate->id)">
            {{ $cate->name }}
        </x-links.categories-shop>
        @endforeach
    </div>
</div>