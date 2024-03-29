<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {

        // return request()->all();
        $brand = Brand::all();
        $color = Color::all();
        $size = Size::all();
        $category = Category::withCount('product')->get();


        $data = Product::orderBy('id', 'desc');
        if ($brand_slug = request()->brand) {
            $db_brand = Brand::where('slug', $brand_slug)->first();
            $data->where('brand_id', $db_brand->id);
        }

        if ($category_slug = request()->category) {
            $db_category  = Category::where('slug', $category_slug)->first();
            $data->whereHas('category', function ($q) use ($db_category) {
                $q->where('product_categories.category_id', $db_category->id);
            });
        }

        if ($search = request()->search) {
            $data->where('name', 'like', "%$search%");
        }

        $data  = $data->paginate(8);
        return view('product.all', compact('data',  'brand', 'color', 'size', 'category'));
    }

    public function detail($slug)
    {
        $data = Product::where('slug', $slug)
            ->with('category', 'brand', 'color', 'size')
            ->first();
        if (!$data) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        return view('product.detail', compact('data'));
    }
}
