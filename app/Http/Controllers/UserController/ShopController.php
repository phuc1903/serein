<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(string $category_id = null, string $keyword = null)
    {
        $categories = Category::all();

        $query = Product::query();

        if ($category_id !== null) {
            $query->where('category_id', '=', $category_id);
            $totalProducts = Product::where('category_id', '=', $category_id)->count();
        } 
        else if($keyword !== null) {
            $query->where('title', 'LIKE', '%'.$keyword.'%');
            $totalProducts = Product::where('title', 'LIKE', '%'.$keyword.'%')->count();
        }    
        else {
            $totalProducts = Product::count();
        }

        $products = $query->latest()->paginate(6);

        return view('shop', [
            'products' => $products,
            'categories' => $categories,
            'totalProducts' => $totalProducts,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->key;
        return $this->index($category_id = null, $keyword);
    }
}
