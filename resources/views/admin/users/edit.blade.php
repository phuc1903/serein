<x-layouts.layout-admin>
    <div class="col l-9 main__admin">
        <form action="{{ route('admin.user.update', $user) }}" method="post" class="col l-9 main__admin"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Sửa vai trò người dùng</h1>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="role">Vai trò</label>
                    <select name="role" id="role" style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                    </select>
                </div>
            </div>
            <div class="main__admin-btn-action">
                <button type="submit" class="btn-admin">Lưu</button>
            </div>
        </form>
    </div>
</x-layouts.layout>
