<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // buat multator
    public function printStatus() {

        $badge = $this->status == 'active'
        ? '<span class="badge badge-success">'. $this->status .  '</span>'
        : '<span class="badge badge-danger">'. $this->status .  '</span>';

        return $badge;
    }
}
