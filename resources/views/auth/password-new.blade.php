<x-layouts.layout>

    <form action="{{ route('password.update') }}" method="post" id="login-form" class="form-main">
        @csrf
        <div class="input-form-with">
            <i class="fa-brands fa-square-facebook"></i>
            <span>Đăng nhập với google</span>
        </div>
        <div class="input-form-with">
            <i class="fa-brands fa-square-facebook"></i>
            <span>Đăng nhập với facebook</span>
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-form-item">
            <input 
            type="text" 
            placeholder="Nhap email" 
            id="email" 
            class="email" 
            name="email" 
            value="{{ old('email') }}"
            autocomplete="current-email"
            >
            <div class="error" id="email_err"></div>
            @error('email')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div id="message" class="error"></div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập mật khẩu" id="password" class="password" name="password" autocomplete="current-password">
            <div class="error" id="password_err"></div>
            @error('password')
                <div class="error" id="password_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập lại mật khẩu" id="cpassword" class="cpassword" name="password_confirmation" autocomplete="current-password">
            {{-- <div class="error" id="password_err"></div> --}}
        </div>
        {{-- <div class="input-form-item">
            <input type="text" placeholder="Nhap mã OTP" id="OTP" class="OTP" name="OTP" autocomplete="current-email">
            <div class="error" id="otp_err"></div>
        </div> --}}
        <div id="message" class="error"></div>
        <div class="input-form-item">
            {{-- <button type="button" id="password-new">Cập nhật lại mật khẩu</button> --}}
            <button type="submit">Cập nhật lại mật khẩu</button>
        </div>
    </form>

</x-layouts.layout>