<x-layouts.layout-admin>


    <div class="col l-9 main__admin">
        <form action="{{ route('admin.category.update', $category) }}" method="post" class="col l-9 main__admin" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Sửa danh mục</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    @if(Str::contains($category->image, 'category_images'))
                        <img src="{{ asset('storage/' . $category->image) }}">
                    @else
                        <img src="{{ asset('img/' . $category->image) }}">
                    @endif
                </div>
                <div class="main__admin-right">
                    <!-- <div class="main__admin-name">Đinh Trọng Phúc</div> -->
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Sửa ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="image" id="typeFile" hidden onchange="previewImage(this);">
                </div>  
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="name">Tên danh mục</label>
                    <input class="@error('name') error @enderror" type="text" id="name" name="name" placeholder="Nhập tên danh mục"  value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="description">Mô tả</label>
                    <input type="text" id="description" name="description" placeholder="Nhập mô tả danh mục" value="{{ old('description', $category->description) }}">
                    @error('description')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" placeholder="Nhập tên danh mục"  value="{{ old('slug', $category->slug) }}">
                    @error('slug')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- <select name="status" id=""  style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                <option value="">Đang hoạt động</option>
                <option value="Ngưng hoạt động">Ngưng hoạt động</option>
            </select> --}}
            <div class="main__admin-btn-action">
                <button type="submit" name="UpdateCategory" class="btn-admin">Lưu</button>
            </div>
        </form>
    </div>


</x-layouts.layout>
