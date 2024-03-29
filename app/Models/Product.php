<?php

namespace App\Models;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'supplier_id',
        'brand_id',
        'slug',
        'name',
        'image',
        'description',
        'qty',
        'buy_price',
        'sale_price',
        'discounted_price',
        'order_count',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }
    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function fav()
    {
        return $this->belongsTo(ProductFav::class);
    }
}
