<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <form action="{{ route('admin.order.update', $order) }}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Sửa đơn hàng</h1>
            <select name="status" id="" style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <option value="{{ $order->status }}">{{ $order->status }}</option>
                @foreach ($statusOrders as $item)
                    <option value="{{ $item}}">{{ $item }}</option>
                @endforeach
            </select>
            <div class="main__admin-btn-action">
                <button type="submit" class="btn-admin">Lưu</button>
            </div>
        </form>
    </div>


</x-layouts.layout>
