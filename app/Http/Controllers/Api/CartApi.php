<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartApi extends Controller
{
    public function addToCart()
    {
        $slug = request()->slug;
        $checkProduct = Product::where('slug', $slug)->first();
        //check product
        if (!$checkProduct) {
            return 'product_not_found';
        }
        //check qty
        if ($checkProduct->qty < 1) {
            return 'not_enough_qty';
        }

        $checkInCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $checkProduct->id)
            ->first();
        if ($checkInCart) {
            $checkInCart->update([
                'qty' => DB::raw("qty+1")
            ]);
        } else {
            Cart::create([
                'product_id' => $checkProduct->id,
                'user_id' => auth()->id(),
                'qty' => 1,
            ]);
        }
        $data = [
            'message' => "success",
            "cart_qty" => Cart::where('user_id', auth()->id())->count()
        ];
        return response()->json($data);
    }

    public function cart()
    {
        $data = Cart::orderBy('id', 'desc')
            ->where('user_id', auth()->id())
            ->with('product')
            ->get();
        return response()->json($data);
    }
    public function removeCart($id)
    {
        Cart::where('id', $id)->delete();
        return 'success';
    }
    public function addQty($id)
    {
        Cart::where('id', $id)->update([
            'qty' => DB::raw('qty+1'),
        ]);
        return 'success';
    }

    public function checkout(Request $request)
    {
        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        $cart = Cart::where('user_id', auth()->id())->get();
        $voucher_id = uniqid();
        foreach ($cart as $c) {
            Order::create([
                'product_id' => $c->product_id,
                'user_id' => auth()->id(),
                'voucher_id' => $voucher_id,
                'qty' => $c->qty,
                'payment_screenshot' => $file_name,
                'bank_name' => $request->bank,
            ]);
        }
        Cart::where('user_id', auth()->id())->delete();
        return 'success';
    }

    public function order()
    {
        $data = Order::where('user_id', auth()->id())
            ->groupBy('voucher_id')
            ->paginate(2);
        foreach ($data as $d) {
            $products = Order::where('voucher_id', $d->voucher_id)
                ->with('product')
                ->get();
            $d->products = $products;
        }
        return response()->json($data);
    }
}
