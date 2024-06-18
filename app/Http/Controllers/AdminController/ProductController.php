<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(4);

        // dd($products);

        return view('admin.products.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:255',
            'detail' => 'required|string|min:5|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);
        
        $product = Product::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'detail' => $validatedData['detail'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
        ]);

        $product->image = 'default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('product_images', $request->image);
            $product->image = $imagePath;
            $product->save();
        }

        $slug = Str::slug($validatedData['title']). '-' . $product->id;
        $validatedData['slug'] = $slug;
        $product->slug = $validatedData['slug'];

        $product->save();

        return back()->with('success', 'Thêm sản phẩm thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::find($product->category_id);

        $categories = Category::where('id', "!=", $category->id)->get();

        return view('admin.products.edit', ['product' => $product, 'category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:255',
            'detail' => 'required|string|min:5|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|file|max:5000|mimes:png,jpg,webp',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('product_images', $request->image);
            $validatedData['image'] = $imagePath;
            if($product->image){
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->update($validatedData);

        return redirect()->route('admin.product.list')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function checkOrderDetails(Request $request)
    {
        $productId = $request->input('id');
        $orderDetails = OrderDetail::where('product_id', $productId)->get();
        
        if ($orderDetails->isEmpty()) {
            return response()->json(['exists' => false, 'test' => $productId]);
        } else {
            return response()->json(['exists' => true, 'orderDetails' => $orderDetails, 'test' => $productId]);
        }
    }

    public function destroy(Product $product)
    {

        DB::transaction(function() use ($product) {
            $orderDetails = OrderDetail::where('product_id', $product->id);

            if ($orderDetails->exists()) {
                $orderDetails->delete();
            }

            if ($product) {
                if($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->delete();
            }
        });

        return response()->json(['message' => 'Xóa sản phẩm thành công']);
    }
}
