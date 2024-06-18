<x-layouts.layout-admin title="{{ Auth::user()->name}}">

    <div class="col l-9 main__admin">
        <h1>Hồ sơ chi tiết</h1>
        <form action="{{ route('info-update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    @if (Str::contains($user->avatar, 'user_images'))
                        <img id="avatar" src="{{ asset('storage/' . $user->avatar) }}">
                    @else 
                    @if (Str::contains($user->avatar, 'https'))
                    <img id="avatar" src="{{ $user->avatar }}">
                    @endif
                    @endif
                </div>
                <div class="main__admin-right">
                    <div class="main__admin-name">{{ $user->name }}</div>
                    <a class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thay đổi ảnh</a>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="avatar" id="typeFile"
                        value="{{ old('avatar', $user->avatar) }}" hidden onclick="previewImage(this);">
                </div>
            </div>

            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $user->name) }}"
                        placeholder="{{ $user->name == '' ? 'Không có' : $user->name }}"
                        >
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="{{ $user->phone == '' ? 'Không có' : $user->phone }}"
                        >
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="address">Địa chỉ của bạn</label>
                    <input type="text" id="address" name="address"
                        value="{{ old('address', $user->address) }}"
                        placeholder="{{ $user->address == '' ? 'Không có' : $user->address }}"
                        >
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="{{ $user->email == '' ? 'Không có' : $user->email }}"
                        >
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="created_at">Ngày đăng ký tài khoản</label>
                    <input type="text" id="created_at" name="created_at"
                        value="{{ old('created_at', $user->created_at) }}" disabled>
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Chức vụ</label>
                    <input type="text" id="role" name="role"
                        value="{{ old('role', $user->role == 1 ? 'Admin' : 'Thành viên') }}" disabled>
                </div>
            </div>
            <div class="main__admin-btn-action">
                <div class="main__admin-btn-item">
                    <button type="submit" class="btn-admin">Lưu thay đổi</button>
                </div>
                <div class="main__admin-btn-item">
                    <a href="{{ route('change-password', $user) }}" class="btn-admin">Đổi mật khẩu</a>
                </div>
            </div>
        </form>
    </div>

</x-layouts.layout-admin>
