<x-layouts.layout>

    <form action="{{ route('password.email') }}" method="post" id="login-form" class="form-main">
        @csrf
        <div class="input-form-item">
            <input 
            type="text" 
            placeholder="Nhap email" 
            id="email" 
            class="email" 
            name="email" 
            value="{{ old('email') }}"
            {{-- autocomplete="current-email" --}}
            >
            <div class="error" id="email_err"></div>
            @error('email')
                <div class="error" id="name_err">{{ $message }}</div>
            @enderror
        </div>
        <div id="message" class="error"></div>
        <a class="forgot-password" href="{{ route('login')}}">Đã có tài khoản</a>
        <div class="input-form-item">
            <button type="submit">Lấy lại mật khẩu</button>
            {{-- <button type="submit" id="ressetPass-btn">Lấy lại mật khẩu</button> --}}
        </div>
    </form>

</x-layouts.layout>