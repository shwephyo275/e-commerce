<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::groupBy('voucher_id')
            ->with('user')
            ->paginate(2);
        foreach ($data as $d) {
            $products = Order::where('voucher_id', $d->voucher_id)
                ->with('product')
                ->get();
            $d->products = $products;
        }

        return view('admin.order.index', compact('data'));
    }

    public function changeOrderStatus()
    {

        $voucher_id = request()->voucher_id;
        $status = request()->status;
        Order::where('voucher_id', $voucher_id)->update([
            'status' => $status,
        ]);


        if ($status == 'deliver') {
            $order =     Order::where('voucher_id', $voucher_id)->get();
            foreach ($order as $o) {
                Product::where('id', $o->product_id)->update([
                    'qty' => DB::raw('qty-' . $o->qty)
                ]);
            }
        }
        return redirect()->back()->with('success', 'order status changed');
    }
}
