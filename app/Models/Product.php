<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'description', 'image', 'price', 
        'category_id', 'color_id', 'material_id', 'theme_id'
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function color() { return $this->belongsTo(Attribute::class, 'color_id'); }
    public function material() { return $this->belongsTo(Attribute::class, 'material_id'); }
    public function theme() { return $this->belongsTo(Attribute::class, 'theme_id'); }
}
