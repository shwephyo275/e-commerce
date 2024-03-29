<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        //app()->setLocale('mm');
        $category = Category::take(8)
            ->whereHas('product', function ($q) {
                $q->take(3);
            })
            ->with('product')
            ->get();

        $categories = Category::take(8)->get();


        return view('home', compact('category', 'categories'));
    }
}
