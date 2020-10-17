<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'product_quantity',
        'description',
        'product_picture',
        'in_date',
        'expiration_date',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id_product'. 'id');
    }
}
