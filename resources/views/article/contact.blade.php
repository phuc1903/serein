<x-layouts.layout>

    <div class="contact container">
        <div class="grid wide">
            <div class="row">
                <div class="col l-6">
                    <div class="about-content">
                        <div class="about-content-top">
                            <div class="about-content-top-icon">#</div>
                            <div class="about-content-top-item">Liên hệ</div>
                        </div>
                        <div class="about-content-title">
                            <h1>
                                Nếu có bất kỳ vấn đề gì thì liên hệ <a href="/">Serein</a> Jewelry
                            </h1>
                        </div>
                        <div class="about-content-list">
                            Nếu bạn muốn gửi một thông điệp trực tiếp cho 
                            chúng tôi, bạn có thể sử dụng mẫu liên hệ dưới 
                            đây. Hãy điền đầy đủ thông tin cần thiết và chsun
                            tôi sẽ liên hệ lại với bạn càng sớm càng tốt. 
                            <a hreft="#">Download Now</a>.
                        </div>
                    </div>
                    <form action="" class="contact-form">
                        <div class="contact-form-item">
                            <input class="contact-form-item-1" type="text" placeholder="Họ và tên">
                            <input class="contact-form-item-2" type="text" placeholder="Email">
                        </div>
                        <div class="contact-form-item">
                            <input type="text" placeholder="Tên chủ thể">
                        </div>
                        <div class="contact-form-item">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Nội dung"></textarea>
                        </div>
                        <button type="submit">Gửi</button>
                    </form>
                </div>
                <div class="col l-6">
                    <div class="about-img">
                        <img src="img/post1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('article.evaluate')

</x-layouts.layout>