<x-layouts.layout-email>
    <h1>Cảm ơn {{ $incoming[0]->name }} đã mua hàng tại {{ env('APP_NAME') }}</h1>

    <a href="{{ route('order.index') }}">Click vào đây để xem chi tiết</a>

    {{-- <p>Incoming: {{ var_dump($incoming[1]) }}</p> --}}
    <table class="mail-table">
        <thead>
            <tr>
                <th>Người đặt</th>
                <th>Địa chỉ giao</th>
                <th>Số điện thoại</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $incoming[1]->name }}</td>
                <td>{{ $incoming[1]->address }}</td>
                <td>{{ $incoming[1]->phone }}</td>
                <td>{{ $incoming[1]->payment_method }}</td>
                <td>{{ $incoming[1]->status }}</td>
            </tr>
        </tbody>
    </table>
</x-layouts.layout-email>
  
