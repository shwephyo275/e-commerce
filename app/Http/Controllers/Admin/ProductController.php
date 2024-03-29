<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::orderBy('id', 'desc')
            ->with('supplier', 'color', 'size', 'brand', 'category')
            ->paginate(10);
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $brand = Brand::all();
        $color = Color::all();
        $size = Size::all();
        $category = Category::all();
        return view('admin.product.create', compact('supplier', 'brand', 'color', 'size', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //upload
        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);


        $created_product =   Product::create([
            'slug' => uniqid(),
            'supplier_id' => $request->supplier,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'image' => $image_name,
            'qty' => $request->qty,
            'discounted_price' => $request->discounted_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'order_count' => 0,
        ]);

        $product = Product::find($created_product->id);
        $product->category()->sync($request->category);
        $product->color()->sync($request->color);
        $product->size()->sync($request->size);

        return redirect()->back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::all();
        $brand = Brand::all();
        $color = Color::all();
        $size = Size::all();
        $category = Category::all();

        $data = Product::where('id', $id)->with('category', 'brand', 'color', 'size')->first();
        if (!$data) {
            return redirect()->back()->with('error', 'Data Not found');
        }
        return view('admin.product.edit', compact('data', 'supplier', 'brand', 'color', 'size', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Product::find($id);
        if ($file = $request->file('image')) {
            File::delete(public_path('/images/' . $data->image));
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        } else {
            $file_name = $data->image;
        }

        $data->update([
            'supplier_id' => $request->supplier,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'image' => $file_name,
            'qty' => $request->qty,
            'discounted_price' => $request->discounted_price,
            'buy_price' => $request->buy_price,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
        ]);

        $data->category()->sync($request->category);
        $data->color()->sync($request->color);
        $data->size()->sync($request->size);

        return redirect()->back()->with('success', 'Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted');
    }
}
