<x-layouts.layout>

    <div class="about container">
        <div class="grid wide">
            <div class="row">
                <div class="col l-6">
                    <div class="about-content">
                        <div class="about-content-top">
                            <div class="about-content-top-icon">#</div>
                            <div class="about-content-top-item">Chào mừng bạn đến Serein Jewelry</div>
                        </div>
                        <div class="about-content-title">
                            <h1>
                                Tại sao bạn nên truy cập <a href="/">Serein</a> Jewelry
                            </h1>
                        </div>
                        <div class="about-content-list">
                            Serein jewelry là một thương hiệu trang sức độc đáo và sang trọng tạo ra với sứ mệnh làm 
                            cho bạn luôn tỏa sáng và tự tin trong mọi khoảnh khắc cuộc sống. Chúng tôi tin rằng trang 
                            sức không chỉ là vật trang sức bình thường mà còn là một biểu tượng cá nhân, thể hiện phong 
                            cách và tâm hồn của bạn
                        </div>
                        <div class="about-content-services">
                            <div class="about-content-services-item">
                                <i class="fa-solid fa-chevron-right"></i>
                                Thiết kế tinh tế
                            </div>
                            <div class="about-content-services-item">
                                <i class="fa-solid fa-chevron-right"></i>
                                Nguyên liệu chất lượng cao
                            </div>
                            <div class="about-content-services-item">
                                <i class="fa-solid fa-chevron-right"></i>
                                Dịch vụ tận tâm
                            </div>
                        </div>
                        <form class="banner-bottom-left">
                            <button type="submit" name="">Mua ngay</button>
                        </form>
                    </div>
                </div>
                <div class="col l-6">
                    <div class="about-img">
                        <img src="img/post1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('article.features')
    @include('article.evaluate')

</x-layouts.layout>