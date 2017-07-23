<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ListProducts()
    {
        $products = Product::orderBy('created_at', 'asc')->get();

        return view('product.index', ['products' => $products]);
    }
}
