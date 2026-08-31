<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wardrobe;
use App\Models\Product;

class RecommendationController extends Controller
{
    public function index()
    {
        $wardrobes = auth()->user()->wardrobes()->with(['category', 'color', 'material', 'theme'])->get();
        return view('user.recommendation', compact('wardrobes'));
    }

    public function match(Request $request)
    {
        $request->validate(['wardrobe_id' => 'required|exists:wardrobes,id']);
        
        $wardrobe = Wardrobe::findOrFail($request->wardrobe_id);
        
        // Content Based Filtering - Hitung Similarity Score
        $products = Product::with(['category', 'color', 'material', 'theme'])
            ->where('category_id', '!=', $wardrobe->category_id) // Aturan Complementary: Jangan rekomendasikan kategori yang sama
            ->get()->map(function($product) use ($wardrobe) {
            $score = 0;
            $reasons = [];
            
            // Pemberian Bobot & Pencatatan Alasan
            if ($product->color_id === $wardrobe->color_id) {
                $score += 3; // Warna paling berpengaruh (3)
                $reasons[] = 'Warna (' . $product->color->name . ')';
            }
            if ($product->theme_id === $wardrobe->theme_id) {
                $score += 2; // Tema berpengaruh (2)
                $reasons[] = 'Tema (' . $product->theme->name . ')';
            }
            if ($product->material_id === $wardrobe->material_id) {
                $score += 1; // Bahan berpengaruh (1)
                $reasons[] = 'Bahan (' . $product->material->name . ')';
            }
            
            $product->similarity_score = $score;
            
            if (count($reasons) > 0) {
                $product->recommendation_reason = 'Direkomendasikan karena memiliki ' . implode(', ', $reasons) . ' yang sama dengan pakaian Anda.';
            } else {
                $product->recommendation_reason = '';
            }

            return $product;
        })->filter(function($product) {
            return $product->similarity_score > 0;
        })->sortByDesc('similarity_score')->take(10); // Ambil Top 10

        return view('user.recommendation_result', compact('wardrobe', 'products'));
    }
}
