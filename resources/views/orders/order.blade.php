<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <h1>Đơn hàng của bạn</h1>
        <a href="{{ route('shop') }}">
            <button class="addProduct" name="addProduct">Đi đến shop</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Ngày thanh toán</th>
                    <th>Phương thức</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body">
                    @foreach ($orders as $order)
                        <tr class="manager-list">
                            <td class="manager-name"><span>{{ $order->name }}</span></td>
                            <td class="manager-name"><span>{{ $order->address }}</span></td>
                            <td class="manager-price"><span>{{ $order->phone }}</span></td>
                            <td class="manager-name"><span>{{ $order->status }}</span></td>
                            <td class="manager-name"><span>{{ number_format($order->totalPrice) }} VNĐ</span></td>
                            <td class="manager-createDay"><span>{{ $order->created_at }}</span></td>
                            <td class="manager-name"><span>{{ $order->payment_method }}</span></td>
                            <td class="manager-action">
                                @can('view', $order)
                                    <div style="display: flex">
                                        <a data-route-api="{{ route('order.print', $order) }}" class="manager-action-item bill_detail print">
                                            <button name="bill_detail" class="bill_detail-item">In</button>
                                        </a>
                                        <a href="{{ route('order.detail', $order) }}" class="manager-action-item bill_detail">
                                            <button name="bill_detail" class="bill_detail-item">Detail</button>
                                        </a>
                                        <form action="{{ route('order.destroy', $order) }}" method="post" class="manager-action-item bill_detail">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background-color: red" name="bill_detail" class="bill_detail-item">Xóa</button>
                                        </form>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-links.pagination :data="$orders" />
            <hr>
        </div>
    </div>

</x-layouts.layout-admin>