<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 56px;
        }

        header {
            width: 100%;
            height: 100px;
            border: 1px dashed transparent;
            border-image: repeating-linear-gradient(0deg, black, black 2px, transparent 2px, transparent 4px);
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            max-height: 100%;
            margin-right: 20px;
        }

        header div {
            flex-grow: 1;
        }

        header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        form {
            width: 100%;
        }

        h3 {
            margin-top: 0;
        }

        table.detail {
            width: 100%;
            border-collapse: collapse;
        }

        table.detail th,
        table.detail td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table.detail img {
            max-width: 100px;
            max-height: 100px;
        }

        table.detail th {
            width: 15%;
        }

        table.detail td {
            width: 17%;
        }
    </style>
</head>

<body>
    <main>
        <header>
            <div>
                <img src="{{ asset('img/logo3.png') }}" alt="">
            </div>
            <div>
                <h2>Đơn hàng của bạn</h2>
                <!-- <span>
                        Chào mừng bạn đến với Serein - điểm đến thú vị cho những người yêu thời trang trang sức.
                        Tại Serein, chúng tôi tự hào giới thiệu những thiết kế trang sức độc đáo và sang trọng,
                        tạo nên những đường nét tinh tế và phong cách đẳng cấp.
                    </span> -->
            </div>
        </header>
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
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            </tbody>
        </table>
</body>

</html>
