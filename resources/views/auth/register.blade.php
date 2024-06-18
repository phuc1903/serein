<x-layouts.layout>
    <form action="{{ route('register-store') }}" id="register-form" method="post" class="form-main">
        @csrf
        <div class="input-form-with">
            <i class="fa-brands fa-google"></i>
            <span>Đăng nhập với Google</span>
        </div>
        <div class="input-form-with">
            <i class="fa-brands fa-square-facebook"></i>
            <span>Đăng nhập với Facebook</span>
        </div>
        <div class="input-form-item">
            <input value="{{ old('name') }}" type="text" placeholder="Họ và Tên" class="name @error('name') error @enderror" id="name" name="name">
            @error('name')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input value="{{ old('email') }}" type="text" class="@error('email') error @enderror" placeholder="Nhập email" class="email" id="email" name="email" autocomplete="email">
            @error('email')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập mật khẩu" class="@error('password') error @enderror" class="password" id="password" name="password" autocomplete="new-password">
            @error('password')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập lại mật khẩu" class="password_confirmation @error('password_confirmation') error @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div id="message" class="error"></div>
        <div class="input-form-item">
            <button type="submit" class="register" id="register-btn" name="submit">Đăng ký</button>
        </div>
    </form>
</x-layouts.layout>
