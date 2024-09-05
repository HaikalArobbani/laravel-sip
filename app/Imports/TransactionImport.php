<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //
        // dd($row);
        if (!empty($row[0]) && !empty($row[1]) && !empty($row[2])) {
            $transaction = new Transaction();
            $transaction->product_id = $row[0];
            $transaction->trx_date = $row[1];
            $transaction->price = $row[2];
            $transaction->save();
            return $transaction;
        }
        return null;
        // 'product_id' => $row[0],
        // 'trx_date'  => $row[1],
        // 'price' => ($row[2]),


    }
}
