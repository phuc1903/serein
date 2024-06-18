<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productSellers = Product::orderBy('sale', 'desc')->limit(4)->get();

        $productNews = Product::orderBy('created_at', 'desc')->limit(4)->get();


        return view('home', ['productSellers' => $productSellers,'productNews' => $productNews,]);
    }
}
