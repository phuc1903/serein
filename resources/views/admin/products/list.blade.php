<x-layouts.layout-admin title="Quản lý sản phẩm">

    <div class="col l-9 main__admin">
        <h1>Quản lý sản phẩm</h1>
        <a href="{{ route('admin.product.create') }}">
            <button class="addProduct" name="addProduct">Add</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Slug</th>
                    <th>Ngày tao</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body" >
                    @foreach ($products as $p)
                        <tr class="manager-list">
                            <td class="manager-name ">
                                <span>{{ Str::words($p->title, 8, '...') }}</span>
                            </td>
                            <td class="manager-img">
                                @if(Str::contains($p->image, 'product_images'))
                                    <img src="{{ asset('storage/' . $p->image) }}">
                                @else
                                    <img src="{{ asset('img/' . $p->image) }}">
                                @endif
                            </td>
                            <td class="manager-description">
                                <span>{{ Str::words($p->description, 20, '...') }}</span>
                            </td>
                            <td class="manager-price">
                                <span>{{ number_format($p->price, 0, ',', '.') }} VNĐ</span>
                            </td>
                            <td class="manager-updateDay">
                                <span> {{ $p->slug }}</span>
                            </td>
                            <td class="manager-updateDay">
                                <span>{{ $p->created_at }}</span>
                            </td>
                            <td class="manager-option">
                                <span>{{ $p->category->name }}</span>
                            </td>

                            <td class="manager-action">
                                <div class="d-flex">
                                    <a 
                                    data-id="{{ $p->id }}" 
                                    data-route-delete="{{ route('admin.product.destroy', $p->id) }}"  
                                    data-route-check="{{ route('admin.product.checkOrderDetails') }}"
                                    data-confirm="Sản phẩm này có liên kết với đơn hàng. Bạn có muốn xóa nó cùng với chi tiết đơn hàng không?"
                                    class="bill_delete delete-button">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <div class="manager-action-item">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.product.edit', $p) }}"
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
            <x-links.paginate :data="$products"/>
        </div>
    </div>

</x-layouts.layout-admin>
