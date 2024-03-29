<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFav;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductApi extends Controller
{
    public function saveProduct()
    {
        $user_id = auth()->id();
        $slug = request()->slug;
        $findProduct = Product::where('slug', $slug)->first();
        if (!$findProduct) {
            return 'product_not_found';
        }

        $checkProductInFav = ProductFav::where('user_id', $user_id)
            ->where('product_id', $findProduct->id)->first();
        if ($checkProductInFav) {
            return 'already_save';
        }
        ProductFav::create([
            'user_id' => $user_id,
            'product_id' => $findProduct->id,
        ]);

        return 'success';
    }

    public function getReview($id)
    {
        $data = ProductReview::where('product_id', $id)
            ->with('user')
            ->get();
        return response()->json($data);
    }
    public function makeReview()
    {
        if (!Product::find(request()->product_id)) {
            return 'not_found';
        }
        $createdReview = ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => request()->product_id,
            'review' => request()->review,
            'rating' => request()->rating,
        ]);

        $data = ProductReview::where('id', $createdReview->id)->with('user')->first();
        return response()->json($data);
    }
}
