<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wardrobe;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;

class WardrobeController extends Controller
{
    public function index()
    {
        $wardrobes = auth()->user()->wardrobes()->with(['category', 'color', 'material', 'theme'])->get();
        return view('user.wardrobes.index', compact('wardrobes'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Attribute::where('type', 'color')->get();
        $materials = Attribute::where('type', 'material')->get();
        $themes = Attribute::where('type', 'theme')->get();
        return view('user.wardrobes.create', compact('categories', 'colors', 'materials', 'themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'color_id' => 'required',
            'material_id' => 'required',
            'theme_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('wardrobes', 'public');
        }

        Wardrobe::create($data);
        return redirect()->route('wardrobes.index')->with('success', 'Pakaian berhasil ditambahkan ke lemari.');
    }

    public function destroy(Wardrobe $wardrobe)
    {
        if ($wardrobe->user_id != auth()->id()) abort(403);
        $wardrobe->delete();
        return back()->with('success', 'Pakaian dihapus dari lemari.');
    }

    public function storeFromProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        Wardrobe::create([
            'user_id' => auth()->id(),
            'name' => $product->name,
            'image' => $product->image, // This assumes image paths are compatible
            'category_id' => $product->category_id,
            'color_id' => $product->color_id,
            'material_id' => $product->material_id,
            'theme_id' => $product->theme_id,
        ]);

        return redirect()->route('wardrobes.index')->with('success', 'Produk dari katalog berhasil ditambahkan ke lemari.');
    }
}
