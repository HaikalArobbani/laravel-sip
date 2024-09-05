<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function showImage()
    {

        return asset('storage/' . $this->image);
    }
    public function printStatus()
    {

        $badge = $this->status == 'Active'
            ? '<span class="badge badge-success">' . $this->status .  '</span>'
            : '<span class="badge badge-danger">' . $this->status .  '</span>';

        return $badge;
    }

    /**
     * Get the categories that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
}
