<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $transactions = Transaction::orderBy('trx_date', 'desc')->limit(10)->get();

        $sql = "SELECT MONTHNAME(trx_date) month, count(*)  total FROM transactions " . "GROUP BY MONTHNAME(trx_date)" . "ORDER BY MONTH(trx_date)";
        $transaction = DB::select($sql);

        $month = [];
        $total = [];
        foreach ($transaction as $transaction) {
            $month[] = $transaction->month;
            $total[] = $transaction->total;
        }
        $chart = [
            'months' => $month,
            'totals' => $total
        ];

        // dd($chart);
        // $data =  [
        //     'chart' => $chart
        // ];
        return view('admin.dashboard', compact('transactions'))->with($chart);
    }
}
