<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'color', 'material', 'theme']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();

        return view('user.catalog.index', compact('products', 'categories'));
    }
}
