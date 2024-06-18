<x-layouts.layout-admin>



    <div class="col l-9 main__admin">
        <form action="{{ route('admin.banner.store') }}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            <h1>Thêm banner</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    <img id="avatar" src="" alt="">
                </div>
                <div class="main__admin-right">
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thêm ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="img" id="typeFile" hidden onchange="previewImage(this);">
                </div>  
            </div>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    <img id="avatarImage" src="" alt="">
                </div>
                <div class="main__admin-right">
                    <div class="btn-admin" id="btn-avatar" onclick="chooseBackground()">Thêm background</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="background" id="backgroundInput" style="display: none;" onchange="previewBackground(this);">
                </div>  
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Tên banner</label>
                    <input type="text" id="name" name="collection" placeholder="Nhập tên collection"  value="">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="email">Tiêu đề</label>
                    <input type="text" name="title" id="email" placeholder="Tiêu đề banner">
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Mô tả</label>
                    <input type="text" id="phone" name="des" placeholder="Nhập mô tả banner">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Đường dẫn</label>
                    <input type="text" id="phone" name="link" placeholder="Nhập đường dẫn từ banner">
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Banner được show hay không</label>
                    <input type="number" id="phone" name="banner_show" placeholder="1 là được show 0 là không">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Nút hành động</label>
                    <input type="text" id="phone" name="action" placeholder="Nhập nội dung nút">
                </div>
            </div>
            <div class="main__admin-btn-action">
                <button type="submit" name="AddBanner" class="btn-admin">Thêm banner</button>
            </div>
        </form>
    </div>

</x-layouts.layout-admin>
