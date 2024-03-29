<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Order;
use App\Models\Outcome;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {

        $orderDates = [
            ['year' => date('Y'), 'month' => date('m'), 'monthh' => date('M')],
        ];

        for ($i = 1; $i <= 5; $i++) {
            $orderDates[] = [
                'year' => date('Y', strtotime("-$i month")),
                'month' => date('m', strtotime("-$i month")),
                'monthh' => date('M', strtotime("-$i month")),
            ];
        }

        $orderDateArray = [];
        $orderData = [];
        foreach ($orderDates as $oD) {
            $orderDateArray[] = $oD['monthh'];
            $orderData[] =  Order::whereYear('created_at', $oD['year'])->whereMonth('created_at', $oD['month'])->count();
        }

        // income outcome data
        $inOutDates = [
            date('Y-m-d')
        ];
        for ($i = 1; $i <= 5; $i++) {
            $inOutDates[] = date('Y-m-d', strtotime("-$i day"));
        }
        $incomeData = [];
        $outcomeData = [];
        foreach ($inOutDates as $iod) {
            $incomeData[] = Income::whereDate('created_at', $iod)->sum('amount');
            $outcomeData[] = Outcome::whereDate('created_at', $iod)->sum('amount');
        }


        return view('dashboard', compact(
            'orderDateArray',
            'orderData',
            'incomeData',
            'inOutDates',
            'outcomeData'
        ));
    }
}
