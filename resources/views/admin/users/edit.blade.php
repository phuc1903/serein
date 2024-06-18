<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <form action="{{ route('admin.user.update', $user) }}" method="post" class="col l-9 main__admin"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Sửa đơn hàng</h1>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="role">Danh mục</label>
                    <select name="role" id="" style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        @if ($user->role == 1)
                        <option value="{{ $user->role }}">Admin</option>
                        <option value="0">User</option>
                        @else
                        <option value="{{ $user->role }}">User</option>
                        <option value="1">Admin</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="main__admin-btn-action">
                <button type="submit" class="btn-admin">Lưu</button>
            </div>
        </form>
    </div>


</x-layouts.layout>
