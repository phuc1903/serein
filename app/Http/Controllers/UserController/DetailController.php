<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(string $id)
    {
        $product = Product::findOrFail($id);

        $categoryId = $product->category_id;

        // dd(session('cart'));

        $relatedProduct = Product::where('category_id', $categoryId)->where('id', '!=', $id)->limit(4)->get();

        // dd($relatedProduct);

        return view('detail', ['product' => $product, 'relatedProduct' => $relatedProduct]);
    }
}
