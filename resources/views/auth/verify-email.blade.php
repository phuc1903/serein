<x-layouts.layout>

    <div style="margin: 200px 40px 20px 40px;">
        <h1 style="margin-bottom: 40px;">Vui lòng xác minh email của bạn thông qua email chúng tôi đã gửi cho bạn</h1>
    
        <p style="font-size: 1.4rem; margin-bottom: 20px;">Nếu chưa nhận được email thì click vào nút dưới đây</p>
        <form action="{{ route('verification.send') }}" method="post" class="contact-form">
            @csrf
            <button type="submit">Gửi lại</button>
        </form>
    </div>
</x-layouts.layout>