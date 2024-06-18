<x-layouts.layout-admin title="Thêm sản phẩm">

    <div class="col l-9 main__admin">
        <form action="{{ route('admin.product.store')}}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            <h1>Thêm sản phẩm</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    <img id="avatar" src="{{ asset('img/default.jpg') }}" alt="">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="main__admin-right">
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Thêm ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="image" id="typeFile"
                        hidden onchange="previewImage(this);">
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="title">Tên sản phẩm</label>
                    <input class="@error('title') error @enderror" type="text" id="title" name="title" placeholder="Nhập tên sản phẩm" value="{{ old('title') }}">
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="price">Giá sản phẩm</label>
                    <input
                        class="@error('price') error @enderror"
                        type="number" id="price"
                        name="price"
                        placeholder="Nhập giá sản phẩm"
                        value="{{ old('price') }}">

                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Mô tả</label>
                    <input class="@error('description') error @enderror"  type="text" id="phone" name="description" placeholder="Nhập mô tả sản phẩm" value="{{ old('description') }}">
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="detail">Chi tiết</label>
                    <input class="@error('detail') error @enderror"  type="text" id="detail" name="detail" placeholder="Nhập mô tả sản phẩm" value="{{ old('detail') }}">
                    @error('detail')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <select class="@error('category_id') error @enderror" id="category_id" name="category_id" style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <option value="default">Chọn danh mục</option>
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}"  {{ old('category_id') == $cate->id ? 'selected' : '' }}>{{ $cate->name }}</option>
                @endforeach
            </select>
            
            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
            <div class="main__admin-btn-action">
                <button type="submit" class="btn-admin">Thêm sản phảm</button>
            </div>
        </form>
    </div>

</x-layouts.layout-admin>
