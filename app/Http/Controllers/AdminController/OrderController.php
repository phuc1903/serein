<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Jobs\SendUpdateStatusOrderMailJob;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $status = null)
    {

        $status = $status !== null ? urldecode($status) : null;

        // dd($status);
        if ($status !== null) {
            $orders = Order::where('status', 'LIKE', '%' . $status . '%')->latest()->paginate(4);
        } else {
            $orders = Order::latest()->paginate(4);
        }

        $totalPrice = 0;

        foreach ($orders as $order) {

            $orderDetails = $order->orderDetails;

            foreach ($orderDetails as $orderDetail) {
                $totalPrice += $orderDetail->price * $orderDetail->quantity;
            }

            $order->totalPrice = $totalPrice;
        }

        return view('admin.orders.list', ['orders' => $orders]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderDetails = $order->orderDetails()->with('product')->get();

        foreach ($orderDetails as $orderDetail) {
            $orderDetail->product_name = $orderDetail->product->title;
            $orderDetail->product_price = $orderDetail->product->price;
            $orderDetail->product_image = $orderDetail->product->image;
            $orderDetail->totalPrice = $orderDetail->product->price * $orderDetail->quantity;
        }

        // dd($orderDetails);

        return view('admin.orders.detail', ['orderDetails' => $orderDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $statusOrders = Order::getStatusOptions();

        $statusOrders = array_diff($statusOrders, [$order->status]);
        return view('admin.orders.edit', ['order' => $order, 'statusOrders' => $statusOrders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // dd($request);

        $status = ['status' => $request->status];

        $order->update($status);

        $user = $order->user;
        
        $dataSendMail = [
            'status' => $request->status,
            'email' => $user->email,
        ];

        dispatch(new SendUpdateStatusOrderMailJob($dataSendMail));
    
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // detail

    public function detail(string $id)
    {
        return view('admin.orders.detail');
    }
}
