<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Prodduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            
            $data = [
                'status' => 200,
                'message' => 'Danh sách sản phẩm',
                'products' => Prodduct::collection($products)
            ];


    
            return response()->json($data, 200);
        }
        catch(\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|min:3|max:255',
            'image' => 'nullable|max:255|file|mimes:png,jpg,web',
            'category_id' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => "Thêm sản phẩm thất bại",
                'errors' => $validator->errors()
            ], 422);
        }
    
        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);
    
        return response()->json([
            'status' => 201,
            'message' => "Thêm sản phẩm thành công",
            'product' => new Prodduct($product)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            return response()->json([
                'status' => 200,
                'message' => "Tìm thấy sản phẩm",
                'product' => Prodduct::collection($product)
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Không tìm thấy sản phẩm',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|min:3|max:255',
            'image' => 'nullable|max:255|file|mimes:png,jpg,web',
            'category_id' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => "Updated sản phẩm thất bại",
                'errors' => $validator->errors()
            ], 422);
        }
    
        $product = Product::find($id);
        $productUpdated = $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $request->image,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
    
        return response()->json([
            'status' => 201,
            'message' => "Update sản phẩm thành công",
            'product' => Prodduct::collection($productUpdated)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::find($id);
    
            if(isset($product)) {
                $product->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Xóa sản phẩm thành công'
                ], 200);
            }
    
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy sản phẩm'
            ], 404);
        }

        catch(\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
