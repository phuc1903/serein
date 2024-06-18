<x-layouts.layout-admin title="Chỉnh sửa {{$product->title}}">

        <form action="{{ route('admin.product.update', $product->id) }}" method="post" class="col l-9 main__admin"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Sửa sản phẩm</h1>
            <div class="main_admin-item">
                <div class="main__admin-avatar">
                    @if(Str::contains($product->image, 'product_images'))
                        <img src="{{ asset('storage/' . $product->image) }}">
                    @else
                        <img src="{{ asset('img/' . $product->image) }}">
                    @endif
                </div>
                <div class="main__admin-right">
                    <div class="btn-admin" id="btn-avatar" onclick="chooseImage()">Sửa ảnh</div>
                    <input class="btn-admin" type="file" accept="image/png, image/jpeg" name="image" id="typeFile"
                        hidden onchange="previewImage(this);">
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="title">Tên sản phẩm</label>
                    <input type="text" id="title" name="title" placeholder="Nhập tên sản phẩm"
                        value="{{ old('title', $product->title) }}">
                    @error('title')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="email">Giá sản phẩm</label>
                    <input type="text" name="price" id="email" placeholder="Giá sản phẩm"
                        value="{{ old('price', $product->price) }}">
                    @error('email')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" cols="44" rows="10">
                        {{ old('description', $product->description) }}
                    </textarea>
                    @error('description')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="44" rows="10">
                        {{ old('detail', $product->detail) }}
                    </textarea>
                    @error('slug')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="main__admin-inputs">
                <div class="col l-6 main__admin-input-item">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" placeholder="Nhập mô tả sản phẩm"
                        value="{{ old('slug', $product->slug) }}">
                    @error('slug')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col l-6 main__admin-input-item">
                    <label for="phone">Danh mục</label>
                    <select name="category_id" id="category" style="margin-bottom: 20px; padding: 15px; border-radius: 8px;">
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @foreach ($categories as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error" id="email_err">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="main__admin-btn-action">
                <button type="submit" name="UpdateProduct" class="btn-admin">Lưu</button>
            </div>
        </form>
    </div>


</x-layouts.layout-admin>
