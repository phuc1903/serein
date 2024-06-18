<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm tổng số đơn hàng
        $totalOrders = Order::count();

        // Đếm số đơn hàng đang xét duyệt
        $totalNoProcessOrders = Order::where('status', 'Đang xét duyệt')->count();

        // Đếm số đơn hàng giao hàng thành công
        $totalSuccessOrders = Order::where('status', 'Giao hàng thành công')->count();

        // Đếm số đơn hàng đang giao hàng
        $totalOrderDelivered = Order::where('status', 'Đang giao hàng')->count();

        // Đếm số đơn hàng đã bị hủy
        $totalOrderCancel = Order::where('status', 'Đã hủy')->count();

        // Tính tổng doanh thu từ các đơn hàng giao hàng thành công
        $totalRevenua = Order::where('status', 'Giao hàng thành công')->sum('total_price');

        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalNoProcessOrders' => $totalNoProcessOrders,
            'totalSuccessOrders' => $totalSuccessOrders,
            'totalOrderDelivered' => $totalOrderDelivered,
            'totalRevenua' => $totalRevenua,
            'totalOrderCancel' => $totalOrderCancel
            
        ]);
    }
}
