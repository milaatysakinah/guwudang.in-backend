<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'user_id',
        'product_name',
        'product_quantity',
        'price',
        'units',
        'description',
        'product_picture',
    ];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id'. 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'. 'id');
    }
}
