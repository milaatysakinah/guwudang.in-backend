<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_invoice',
        'id_product',
        'transaction_id',
        'transaction_date',
        'order_quantity',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'id_invoice'. 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id_product'. 'id');
    }

    public function transaction(){
        return $this->belongsTo(TransactionType::class, 'transaction_id'. 'id');
    }
}
