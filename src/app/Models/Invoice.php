<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_user',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer'. 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user'. 'id');
    }
}
