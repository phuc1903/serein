<x-layouts.layout-email>
    
    <h2>Trạng thái đơn hàng của bạn đã được cập nhật thành {{ $incoming['status'] }}</h2>
    <p>Vào lịch sử mua hàng của trang website để xem chi tiết</p>
    <a href="{{ route('order.index') }}">Hoặc click vào đây để đến trang</a>
    
</x-layouts.layout-email>

