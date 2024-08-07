<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <h1>Quản lý đơn hàng</h1>
        <div class="d-flex">
            @php
                $currentStatus = request()->route('status');
            @endphp

            <a class="filter {{ is_null($currentStatus) ? 'active' : '' }}" href="{{ route('admin.order.list') }}">Xem tổng đơn hàng</a>

            <a class="filter {{ $currentStatus == 'Giao hàng thành công' ? 'active' : '' }}" href="{{ route('admin.order.status', 'Giao hàng thành công') }}">Xem đơn hàng đã bán</a>

            <a class="filter {{ $currentStatus == 'Đang xét duyệt' ? 'active' : '' }}" href="{{ route('admin.order.status', 'Đang xét duyệt') }}">Xem đơn hàng chưa xét duyệt</a>

            <a class="filter {{ $currentStatus == 'Đang giao hàng' ? 'active' : '' }}" href="{{ route('admin.order.status', 'Đang giao hàng') }}">Xem đơn hàng đang giao</a>

            <a class="filter {{ $currentStatus == 'Đã hủy' ? 'active' : '' }}" href="{{ route('admin.order.status', 'Đã hủy') }}">Xem đơn hàng đã bị hủy</a>
        </div>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Người đặt hàng</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>Thương thức TT</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body" id="orders">
                    @foreach ($orders as $order)

                    <tr class="manager-list">
                        <td class="manager-name"><span>{{ $order->name }}</span></td>
                        <td class="manager-price"><span>{{ $order->phone }}</span></td>
                        <td class="manager-name"><span>{{ $order->address }}</span></td>
                        <td class="manager-name"><span>{{ $order->payment_method }}</span></td>
                        <td class="manager-name"><span>{{ $order->status }}</span></td>
                        <td class="manager-name"><span>{{ number_format($order->totalPrice) }}</span></td>
                        <td class="manager-name"><span>{{ $order->created_at }}</span></td>
                        {{-- <td class="manager-createDay"><span>{{ $order->updated_at }}</span></td> --}}
                        <td class="manager-action">
                            <div class="d-flex">
                                <a href="{{ route('admin.order.edit', $order)}}" class="manager-action-item bill_detail update-status">
                                    <button name="bill_detail" class="bill_detail-item">Update</button>
                                </a>
                                <a href="{{ route('admin.order.show', $order)}}" class="manager-action-item bill_detail">
                                    <button name="bill_detail" class="bill_detail-item">Detail</button>
                                </a>
                                {{-- <a data-order-id="${element.id}" class="manager-action-item bill_detail print_order">
                                    <button name="bill_detail" class="bill_detail-item">In</button>
                                </a> --}}
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('pagination::bootstrap-4') }}
            {{-- <x-links.pagination :data="$orders" /> --}}
        </div>
    </div>


</x-layouts.layout-admin>
