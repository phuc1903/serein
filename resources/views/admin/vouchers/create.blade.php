<x-layouts.layout-admin>

    <div class="col l-9 main__admin">
        <form action="{{ route('admin.voucher.store') }}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            <h1>Thêm sản phẩm</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    <img id="avatar" src="" alt="">
                </div>
                <div class="main__admin-right">
                    <!-- <div class="main__admin-name">Đinh Trọng Phúc</div> -->
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thêm ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="img" id="typeFile" hidden onchange="previewImage(this);">
                </div>  
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm"  value="">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="email">Giá sản phẩm</label>
                    <input type="text" name="price" id="email" placeholder="Giá sản phẩm">
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Mô tả</label>
                    <input type="text" id="phone" name="description" placeholder="Nhập mô tả sản phẩm">
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="address">Số lượng</label>
                    <input type="number" id="address" name="quantity" placeholder="Số lượng sản phẩm">
                </div>
            </div>
            <select name="category" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>
            <div class="main__admin-btn-action">
                <button type="submit" name="AddProduct" class="btn-admin">Thêm sản phảm</button>
            </div>
        </form>
    </div>


</x-layouts.layout-admin>
