<x-layouts.layout>
    <form action="{{ route('change-password.store', $user) }}" method="post" id="change-password-form" class="form-main">
        @csrf
        <div id="message" class="error">
            @if(session('error'))
                {{ session('error') }}
            @endif
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập mật khẩu cũ" id="passwordOld" class="password" name="passwordOld" autocomplete="current-password">
            @error('passwordOld')
                <div class="error" id="passwordOld_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập mật khẩu mới" id="password" class="password" name="password" autocomplete="new-password">
            @error('password')
                <div class="error" id="password_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <input type="password" placeholder="Nhập lại mật khẩu mới" id="password_confirmation" class="password" name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation')
                <div class="error" id="password_confirmation_err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-form-item">
            <button type="submit">Cập nhật lại mật khẩu</button>
        </div>
    </form>
</x-layouts.layout>
