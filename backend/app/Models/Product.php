<?php

namespace App\Models;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'other_name',
        'category', // 1=fruit, 2=vegetable, 3=fertilizer
        'amount',
        'kilos',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
