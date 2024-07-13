<?php

namespace App\Models;

use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasProfilePhoto;
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'product_photo_path',
        'price',
        'waiting_times',
        'view_count',
    ];
    

    // public function getProductPhotoUrlAttribute()
    // {
    //     // Assuming your product photo URL is stored in a column named 'photo_url'
    //     // You can manipulate the URL as needed before returning it
    //     return $this->attributes['product_photo_path'];
    // }
    // /**
    //  * The accessors to append to the model's array form.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $appends = [
    //     'product_photo_url',
    // ];
}
