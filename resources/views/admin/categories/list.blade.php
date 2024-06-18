<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <h1>Quản lý danh mục</h1>
        <a href="{{ route('admin.category.create') }}">
            <button class="addProduct" name="addProduct">Add</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Tên danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Slug</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body">
                    @foreach ($categories as $cate)
                        <tr class="manager-list">
                            <td class="manager-name">
                                <span>{{ $cate->name }}</span>
                            </td>
                            <td class="manager-img">
                                @if(Str::contains($cate->image, 'category_images'))
                                    <img src="{{ asset('storage/' . $cate->image) }}">
                                @else
                                    <img src="{{ asset('img/' . $cate->image) }}">
                                @endif
                            </td>
                            <td class="manager-price">
                                <span>{{ $cate->description }}</span>
                            </td>
                            <td class="manager-price">
                                <span>{{ $cate->slug }}</span>
                            </td>
                            <td class="manager-action">
                                <div class="d-flex">
                                    <a 
                                    data-id="{{ $cate->id }}"
                                    data-route-delete="{{ route('admin.category.destroy', $cate->id) }}" 
                                    data-route-check="{{ route('admin.category.checkProduct')}}"
                                    data-confirm="Có một số sản phẩm đã liên kết danh mục này. Nếu xóa danh mục sẽ xóa hết sản phẩm!"
                                    class="bill_delete delete-button"
                                    >
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <div class="manager-action-item">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.category.edit', $cate) }}"
                                        class="manager-action-item bill_detail">
                                        <div class="manager-action-item">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-links.pagination :data="$categories" />
        </div>
    </div>

</x-layouts.layout-admin>
