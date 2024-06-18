<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::latest()->paginate(4);

        return view('admin.categories.list', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:255',
            'image' => 'nullable|file|max:5000|mimes:png,jpg,webp',
            'slug' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        $category->image = 'default.jpg';
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('category_images', $request->image);
            $category->image = $imagePath;
            $category->save();
        }

        $slug = Str::slug($validatedData['name']). '-' . $category->id;
        $validatedData['slug'] = $slug;
        $category->slug = $validatedData['slug'];

        $category->save();

        return back()->with('success', 'Thêm danh mục thành công');
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
    public function edit(Category $category)
    {
        // $category = Category::findOrFail($category);

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:255',
            'slug' => 'nullable|string|min:3|max:255|unique:categories',
            'image' => 'nullable|file|max:5000|mimes:png,jpg,webp',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('category_images', $request->image);
            $validatedData['image'] = $imagePath;
            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
        }

        if (!$request->slug) {
            $validatedData['slug'] = $request->name . '-' . $category->id;
        }


        // dd($validatedData);
        $category->update($validatedData);

        return redirect()->route('admin.category.list')->with('success', 'Cập nhật danh mục thành công');
    }


    public function checkProduct(Request $request)
    {
        $CategoryId = $request->input('id');
        $productByCategory = Product::where("category_id", $CategoryId)->get();
        
        if ($productByCategory->isEmpty()) {
            return response()->json(['exists' => false, 'test' => $CategoryId]);
        } else {
            return response()->json(['exists' => true, 'productByCategory' => $productByCategory, 'test' => $CategoryId]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::transaction(function() use ($category) {

            if ($category) {
                $category->delete();
                Storage::disk('public')->delete($category->image);
            }
        });

        return response()->json(['message' => 'Xóa danh mục thành công']);
    }

    public function setCategoryIdProduct(Category $category)
    {
        $productByCate = Product::where('category_id', $category);

        dd($productByCate);
    }
}
