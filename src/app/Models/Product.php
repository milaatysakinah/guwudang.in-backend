<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product_type',
        'id_user',
        'product_name',
        'price',
        'units',
    ];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id'. 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'. 'id');
    }
}
