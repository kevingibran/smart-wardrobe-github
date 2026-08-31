<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'color', 'material', 'theme'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Attribute::where('type', 'color')->get();
        $materials = Attribute::where('type', 'material')->get();
        $themes = Attribute::where('type', 'theme')->get();
        return view('admin.products.create', compact('categories', 'colors', 'materials', 'themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'color_id' => 'required',
            'material_id' => 'required',
            'theme_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Attribute::where('type', 'color')->get();
        $materials = Attribute::where('type', 'material')->get();
        $themes = Attribute::where('type', 'theme')->get();
        return view('admin.products.edit', compact('product', 'categories', 'colors', 'materials', 'themes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'color_id' => 'required',
            'material_id' => 'required',
            'theme_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
            
            // Delete old image if needed (optional, keeping it simple for now)
            // if ($product->image && \Storage::disk('public')->exists($product->image)) {
            //     \Storage::disk('public')->delete($product->image);
            // }
        } else {
            // retain old image
            unset($data['image']);
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk dihapus.');
    }
}
