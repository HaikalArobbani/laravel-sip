<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Imports\TransactionImport;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Category;
use PhpParser\Node\Stmt\Return_;

class TransactionController extends Controller
{
    //
    public function  create()
    {
        return view('admin.transaction.create');
    }

    public function import(Request $request)
    {
        // save excel
        $rules = [
            'excel' => 'required',
        ];
        $messages = [
            'excel.required' => 'File tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('transaction.create')
                ->withErrors($validator)->withInput($request->all());
        }

        // Excel::import($excel, function ($reader) {
        //     foreach ($reader->toArray() as $row) {
        //         Transaction::firstORCreate($row);
        //     }
        // });


        // $excel = $request->file('excel')->store('transactions', 'public');

        Excel::import(new TransactionImport, $request->file('excel'));

        // $transaction = new Transaction();
        // $transaction->excel = $excel;
        // $transaction->save();
        \Session::flash('message', 'Transaction succesfully import');
        return redirect()->route('transaction.index');
    }

    public function index()
    {
        $product = Product::all();
        $transactions = Transaction::orderBy('trx_date', 'desc')->paginate(5);
        return view('admin.transaction.index', compact('transactions', 'product'));
    }

    public function lihat()
    {
        $product = Product::all();
        $transactions = Transaction::orderBy('trx_date', 'desc')->paginate(5);
        return view('admin.transaction.index', compact('transactions', 'product'));
    }



    public function export()
    {
        return Excel::download(new TransactionExport, 'users.xlsx');
    }

    // public function store(Request $request)
    // {
    //     $rules = [
    //         'trx_date' => 'required',
    //         'price' => 'required',
    //     ];
    //     $messages = [
    //         'trx_date.required' => 'Trx Date tidak boleh kosong',
    //         'price.required' => 'Price tidak boleh kosong'
    //     ];
    //     $validator = Validator::make($request->all(), $rules, $messages);
    //     if ($validator->fails()) {
    //         return redirect()->route('transaction.create')->withErrors($validator)->withInput($request->all());
    //     }
    //     $transaction = new Transaction();
    //     $transaction->trx_date = $request->trx_date;
    //     $transaction->price = $request->price;
    //     $transaction->save();
    //     \Session::flash('message', 'Transaction succesfully saved');
    //     return redirect()->route('transaction.index');
    // }
}
