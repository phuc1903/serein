<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewOrderMailJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->latest()->paginate(4);

        $totalPrice = 0;

        foreach ($orders as $order) {

            $orderDetails = $order->orderDetails;

            foreach ($orderDetails as $orderDetail) {
                $totalPrice += $orderDetail->price * $orderDetail->quantity;
            }

            $order->totalPrice = $totalPrice;
        }

        // dd($orders);

        return view('orders.order', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carts = session()->get('carts');

        if (isset($carts)) {
            if (Auth::check()) {
                $user = Auth::user();
                if (!$user->phone) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập số điện thoại và đầy đủ thông tin');
                }
                if (!$user->address) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập địa chỉ và đầy đủ thông tin');
                }
                if (!$user->name) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập tên và đầy đủ thông tin');
                }
                if (!$user->email) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập email và đầy đủ thông tin');
                }

                $totalPriceOrder = 0;
                foreach($carts as $cart) {
                    $totalPriceOrder += $cart['price'];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'status' => "Đang xét duyệt",
                    'payment_method' => "cod",
                    'total_price' => $totalPriceOrder,
                ]);

                foreach ($carts as $cart) {
                    $orderDetails = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $cart['product_id'],
                        'quantity' => $cart['quantity'],
                        'price' => $cart['price'],
                    ]);
                }

                $orderMail = [$user, $order];
                if($orderMail) {
                    dispatch(new SendNewOrderMailJob($orderMail));
                }
                if ($orderDetails && $order) {
                    $cartsDelete = session()->pull('carts');
                    if ($cartsDelete) {
                        // dd($orderMail);
                        return redirect()->back()->with('success', 'Đơn hàng đã đặt thành công, Chờ xét duyệt');
                    }
                }
            }
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request) 
    {
        $carts = session()->get('carts');
        if (isset($carts)) {
            if (Auth::check()) {
                $user = Auth::user();
                if (!$user->phone) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập số điện thoại và đầy đủ thông tin');
                }
                if (!$user->address) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập địa chỉ và đầy đủ thông tin');
                }
                if (!$user->name) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập tên và đầy đủ thông tin');
                }
                if (!$user->email) {
                    return redirect()->route('info')->with('error', 'Vui lòng nhập email và đầy đủ thông tin');
                }
                
                $totalPriceOrder = 0;
                foreach($carts as $cart) {
                    $totalPriceOrder += $cart['price'];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'status' => "Đang xét duyệt",
                    'payment_method' => "momo",
                    'total_price' => $totalPriceOrder,
                ]);

                foreach ($carts as $cart) {
                    $orderDetails = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $cart['product_id'],
                        'quantity' => $cart['quantity'],
                        'price' => $cart['price'],
                    ]);
                }

                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

                $partnerCode = env('MOMO_PARTNERCODE');
                $accessKey = env('MOMO_ACCESSKEY');
                $secretKey = env('MOMO_SERCETKEY');
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $totalPriceOrder;
                $orderId = time() . "";
                $redirectUrl = route('order.index');
                $ipnUrl = route('order.index');
                $extraData = "";

                $requestId = time() . "";
                $requestType = "payWithATM";
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                // dd($signature);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json

                dd($jsonResult)
                

                // $orderMail = [$user, $order];
                // if($orderMail) {
                //     dispatch(new SendNewOrderMailJob($orderMail));
                // }
                // if ($orderDetails && $order) {
                //     $cartsDelete = session()->pull('carts');
                //     if ($cartsDelete) {
                //         // dd($orderMail);
                //         return redirect()->to($jsonResult['payUrl'])->with('success', 'Thanh toán thành công');
                //     }
                // }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        // dd($order);
        if ($order->status !== "Đang xét duyệt") {
            return redirect()->back()->with('error', 'Hiện tại đơn hàng không thể xóa');
        }

        $order->delete();

        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function detail(Order $order)
    {
        Gate::authorize('detail', $order);

        $orderDetails = $order->orderDetails()->with('product')->get();

        foreach ($orderDetails as $orderDetail) {
            $orderDetail->product_name = $orderDetail->product->title;
            $orderDetail->product_price = $orderDetail->product->price;
            $orderDetail->product_image = $orderDetail->product->image;
            $orderDetail->totalPrice = $orderDetail->product->price * $orderDetail->quantity;
        }

        return view('orders.order-detail', ['orderDetails' => $orderDetails]);
    }

    public function OrderByUserApi(Order $order)
    {
        return view('admin.orders.printOrder', ['order' => $order]);
    }

}
