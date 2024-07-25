<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <h1>Danh sách sản phẩm yêu thích</h1>
        <a class="addProduct" href="{{ route('shop') }}">Add</a>
        <div class="manager-main" style="margin-top: 40px;">
            @if ($favorites != [])
                <table class="manager-table" style="width: 100%;">
                    <tr class="manager-header">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá sản phẩm</th>
                        <th>Ngày thêm</th>
                        <th>Hành động</th>
                    </tr>
                    <tbody class="manager-body">
                        @foreach ($favorites as $index => $item)
                            <tr class="manager-list">
                                <td class="manager-name"><span>{{ $index + 1 }}</span></td>
                                <td class="manager-name"><span>{{ $item->title }}</span></td>
                                <td class="manager-img">
                                    @if (Str::contains($item->image, 'product_images'))
                                        <img src="{{ asset('storage/' . $item->image) }}">
                                    @else
                                        <img src="{{ asset('img/' . $item->image) }}">
                                    @endif
                                </td>
                                <td class="manager-price"><span>{{ number_format($item->price) }} VNĐ</span></td>
                                <td class="manager-createDay"><span>{{ $item->created_at }}</span></td>
                                <td class="manager-action">
                                    <form action="{{ route('favorite.destroy', $item) }}"
                                        class="manager-action-item bill_detail" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="bill_detail" class="bill_detail-item">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>
                <x-links.paginate :data="$favorites" />
            @else
                <h1>Danh sách rỗng</h1>
            @endif
        </div>
    </div>

</x-layouts.layout-admin>
