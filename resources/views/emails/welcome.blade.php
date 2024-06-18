<div class="mail">
    <h1>Chào mừng bạn đến {{ env('APP_NAME') }}</h1>
    <p>Xin chào {{ $user->name }},</p>
    <p>Cảm ơn bạn đã đến với {{ env('APP_NAME') }}. Hãy cập nhật thêm thông tin của bạn bằng cách nhấn vào nút dưới đây:
    </p>
    <a href="{{ route('info') }}">Hãy cập nhật thông tin tại đây</a>
</div>
