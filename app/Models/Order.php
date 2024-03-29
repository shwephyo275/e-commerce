<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['voucher_id', 'product_id', 'user_id', 'qty', 'bank_name', 'payment_screenshot', 'status'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->payment_screenshot);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
