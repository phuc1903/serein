<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <div class="block-dashboard">
            <h1>Quản lý đơn hàng</h1>
            <div class="d-flex">
                <h2 style="margin-bottom: 40px; font-size: 1.8rem">Tổng doanh thu: <span>{{ number_format($totalRevenua) }} VNĐ</span></h2>
            </div>
            <div class="row">
                <div class="col l-4">
                    <div class="card">
                        <h2>Tổng đơn hàng</h2>
                        <p>{{ $totalOrders }}</p>
                        <a class="btn-dashboard" href="{{ route('admin.order.list')}}">Xem tổng đơn hàng</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn hàng đã bán</h2>
                        <p>{{ $totalSuccessOrders }}</p>
                        <a class="btn-dashboard" href="{{ route('admin.order.status', 'Giao hàng thành công')}}">Xem đơn hàng đã bán</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn hàng chưa xét duyệt</h2>
                        <p>{{ $totalNoProcessOrders }}</p>
                        <a class="btn-dashboard" href="{{ route('admin.order.status', 'Đang xét duyệt')}}">Xem dơn hàng chưa xét duyệt</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn đang giao</h2>
                        <p>{{ $totalOrderDelivered }}</p>
                        <a class="btn-dashboard" href="{{ route('admin.order.status', 'Đang giao hàng')}}">Xem dơn hàng đang giao</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn đã bị hủy</h2>
                        <p>{{ $totalOrderCancel }}</p>
                        <a class="btn-dashboard" href="{{ route('admin.order.status', 'Đã hủy')}}">Xem dơn hàng đã bị hủy</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-dashboard container">
            <h1>Quản lý sản phẩm</h1>
            <div class="row">
                <div class="col l-4">
                    <div class="card">
                        <h2>Tổng sản phẩm</h2>
                        <p>1</p>
                        <a class="btn-dashboard" href="">Xem tổng sản phẩm</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Sản phẩm sắp hết</h2>
                        <p>1</p>
                        <a class="btn-dashboard" href="">Xem </a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn hàng chưa xử lý</h2>
                        <p>1</p>
                        <a class="btn-dashboard" href="">Xem dơn hàng chưa xử lí</a>
                    </div>
                </div>
                <div class="col l-4">
                    <div class="card">
                        <h2>Đơn đang giao</h2>
                        <p>1</p>
                        <a class="btn-dashboard" href="">Xem dơn hàng chưa xử lí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.layout-admin>