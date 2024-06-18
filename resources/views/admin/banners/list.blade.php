<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <h1>Quản lý banner</h1>
        <a href="{{ route('admin.banner.create') }}">
            <button class="addProduct" name="addProduct">Add</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Bộ sưu tập</th>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Đường dẫn</th>
                    <th>Hiển thị</th>
                    <th>Nút</th>
                    <th>background</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body">
                    <tr class="manager-list">
                        <td class="manager-name">
                            <span></span>
                        </td>
                        <td class="manager-img">
                            <img src="">
                        </td>
                        <td class="manager-price">
                            <span></span>
                        </td>
                        <td class="manager-price line-champ-3">
                            <span></span>
                        </td>
                        <td class="manager-updateDay">
                            <span></span>
                        </td>
                        <td class="manager-updateDay">
                            <span></span>
                        </td>
                        <td class="manager-name">
                            <span></span>
                        </td>
                        <td class="manager-img">
                            <img src="">
                        </td>
                        <td class="manager-action">
                            <a href="{{ route('admin.banner.destroy', 1)}}" class="bill_delete">
                                <div class="manager-action-item">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
                            </a>
                            <a href="{{ route('admin.banner.edit', 1)}}" class="manager-action-item bill_detail">
                                <div class="manager-action-item">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <x-links.pagination :data="$banners" />
        </div>
    </div>


</x-layouts.layout-admin>
