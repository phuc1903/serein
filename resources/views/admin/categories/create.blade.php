<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <form action="{{ route('admin.category.store') }}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            <h1>Thêm danh mục</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    <img id="avatar" src="" alt="">
                </div>
                <div class="main__admin-right">
                    <!-- <div class="main__admin-name">Đinh Trọng Phúc</div> -->
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thêm ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="image" id="typeFile" hidden onchange="previewImage(this);">
                </div>  
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Tên danh mục</label>
                    <input type="text" id="name" name="name" placeholder="Nhập tên danh mục"  value="">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Mô tả</label>
                    <input type="text" id="phone" name="description" placeholder="Nhập mô tả danh mục">
                </div>
            </div>
            {{-- <select name="status" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <option value="Đang hoạt động">Đang hoạt động</option>
                <option value="Ngưng hoạt động">Ngưng hoạt động</option>
            </select> --}}
            <div class="main__admin-btn-action">
                <button type="submit" name="AddCategory" class="btn-admin">Thêm danh mục</button>
            </div>
        </form>
    </div>


</x-layouts.layout-admin>
