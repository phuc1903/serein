<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <h1>Quản lý Voucher</h1>
        <a href="{{ route('admin.voucher.create') }}">
            <button class="addProduct" name="addProduct">Add</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>code</th>
                    <th>Hình ảnh</th>
                    <th>discount_type</th>
                    <th>discount_value</th>
                    <th>discount_max</th>
                    <th>quantity</th>
                    <th>user_count</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body">
                    <tr class="manager-list">
                        <td class="manager-name">
                            <span></span>
                        </td>
                        <td class="manager-img">
                            <img src="#">
                        </td>
                        <td class="manager-price">
                            <span></span>
                        </td>
                        <td class="manager-price">
                            <span></span>
                        </td>
                        <td class="manager-price">
                            <span></span>
                        </td><td class="manager-price">
                            <span></span>
                        </td><td class="manager-price">
                            <span></span>
                        </td>
                        <td class="manager-updateDay">
                            <span></span>
                        </td>
                        <td class="manager-updateDay">
                            <span></span>
                        </td>
                        
                        <td class="manager-action">
                            <a href="{{ route('admin.voucher.destroy', 1) }}" class="bill_delete">
                                <div class="manager-action-item">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                            </a>
                            <a href="{{ route('admin.voucher.edit', 1)}}" class="manager-action-item bill_detail">
                                <div class="manager-action-item">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>


</x-layouts.layout-admin>
