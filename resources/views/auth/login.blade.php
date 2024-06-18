<x-layouts.layout>

    <form method="post" action="{{ route('login-store') }}" id="login-form" class="form-main">
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="input-form-with">
            <i class="fa-brands fa-square-facebook"></i>
            <span>Đăng nhập với google</span>
        </div>
        <div class="input-form-with">
            <i class="fa-brands fa-square-facebook"></i>
            <span>Đăng nhập với facebook</span>
        </div>
        <div class="input-form-item">
            <input 
            type="email" 
            placeholder="Nhap email" 
            id="email" 
            class="email @error('password') error @enderror" 
            name="email" 
            value="{{ old('email') }}"
            autocomplete="current-email">
            @error('email')
                <div class="error" id="email_err">{{ $message }}</div>
            @enderror
            <div class="error" id="email_err"></div>
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập mật khẩu" id="password" class="password @error('password') error @enderror" name="password" autocomplete="current-password">
            @error('password')
                <div class="error" id="email_err">{{ $message }}</div>
            @enderror
            <div class="error" id="password_err"></div>
        </div>
        <div id="message" class="error"></div>
        <a class="forgot-password" href="{{ route('password.request')}}">Quên mật khẩu</a>
        <div class="input-form-item">
            <button type="submit" id="login-btn">Đăng nhập</button>
        </div>
        
    </form>
</x-layouts.layout>