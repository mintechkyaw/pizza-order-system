<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected    $primaryKey = 'order_id';
    protected $fillable = [
        'order_code',
        'user_id',
        'total_price',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_date = now()->toDateString();
            $order->order_time = now()->toTimeString();
        });
    }
}
