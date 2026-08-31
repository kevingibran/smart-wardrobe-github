<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wardrobe;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $wardrobesCount = Wardrobe::count();
        $recentProducts = Product::with(['category', 'color'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('productsCount', 'wardrobesCount', 'recentProducts'));
    }
}
