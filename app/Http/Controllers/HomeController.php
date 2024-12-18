<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $products = Product::query();

        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        if ($request->has('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $products->with('photos')->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
