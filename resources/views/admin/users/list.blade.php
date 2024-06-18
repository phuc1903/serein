<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <h1>Quản lý tài khoản khách hàng</h1>
        <a href="{{ route('register') }}">
            <button class="addProduct" name="addProduct">Add</button>
        </a>
        <div class="manager-main">
            <table class="manager-table" style="width: 100%;">
                <tr class="manager-header">
                    <th>Tên sản khách hàng</th>
                    <th>Hình ảnh</th>
                    <th>email</th>
                    <th>Admin</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Hành động</th>
                </tr>
                <tbody class="manager-body">
                    @foreach ($users as $user)
                    <tr class="manager-list">
                        <td class="manager-name">
                            <span>{{ $user->name }}</span>
                        </td>
                        <td class="manager-img">
                            @if(Str::contains($user->avatar, 'user_images'))
                                    <img src="{{ asset('storage/' . $user->avatar) }}">
                                @else
                                    <img src="{{ $user->avatar}}">
                                @endif
                        </td>
                        <td class="manager-price">
                            <span>{{ $user->email }}</span>
                        </td>
                        <td class="manager-price">
                            <span>{{ $user->role }}</span>
                        </td>
                        <td class="manager-status">
                            <span>{{ $user->phone }}</span>
                        </td>
                        <td class="manager-status">
                            <span>{{ Str::words($user->address, 3) }}</span>
                        </td>
                        <td class="manager-status">
                            <span>{{ $user->created_at }}</span>
                        </td>
                        <td class="manager-updateDay">
                            <span>{{ $user->updated_at }}</span>
                        </td>
                        <td class="manager-action">
                            <div class="d-flex">
                                <a href="{{ route('admin.user.destroy', $user) }}" class="bill_delete">
                                    <div class="manager-action-item">
                                        <i class="fa-solid fa-trash"></i>
                                    </div>
                                </a>
                                <a href="{{ route('admin.user.edit', $user) }}" class="manager-action-item bill_detail">
                                    <div class="manager-action-item">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <x-links.pagination :data="$users" />
        </div>
    </div>

</x-layouts.layout-admin>
