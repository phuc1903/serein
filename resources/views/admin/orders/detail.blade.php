<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <h1>Danh sách sản phẩm trong đơn hàng</h1>
        <a href="{{ route('admin.order.list') }}">
            <button class="addProduct" name="addProduct">Trở về đơn hàng</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng giá</th>
                </tr>
                <tbody class="manager-body">
                    @foreach ($orderDetails as $orderDetail)
                    <tr class="manager-list">
                        <td class="manager-name">
                            <span>{{ $orderDetail->product_name }}</span>
                        </td>
                        <td class="manager-img">
                            @if(Str::contains($orderDetail->product_image, 'product_images'))
                                    <img src="{{ asset('storage/' . $orderDetail->product_image) }}">
                                @else
                                    <img src="{{ asset('img/' . $orderDetail->product_image) }}">
                                @endif
                        </td>
                        <td class="manager-price">
                            <span>{{ number_format($orderDetail->price) }} VNĐ</span>
                        </td>
                        <td class="manager-price">
                            <span>{{ $orderDetail->quantity }}</span>
                        </td>
                        <td class="manager-status">
                            <span>{{ number_format($orderDetail->totalPrice) }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>

</x-layouts.layout-admin>