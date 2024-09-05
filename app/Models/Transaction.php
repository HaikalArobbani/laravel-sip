<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function price()
    {
        $price = $this->price;

        // Membuat instance NumberFormatter untuk locale Indonesia dan tipe mata uang
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);

        // Memformat harga ke dalam mata uang Rupiah
        $formattedPrice = $formatter->formatCurrency($price, 'IDR');

        return $formattedPrice;
    }

    public function dateFormat()
    {
        $date = $this->trx_date;
        $formattedDate = date('d-m-Y', strtotime($date));
        return $formattedDate;
    }

    protected $fillable = [
        'product_id',
        'trx_date',
        'price',
    ];
}
