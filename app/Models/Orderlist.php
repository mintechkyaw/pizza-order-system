<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_list_id';
    protected $fillable = [
        'order_code',
        'product_id',
        'quantity',
        'price_per_unit',
        'total_price'
    ];
}
