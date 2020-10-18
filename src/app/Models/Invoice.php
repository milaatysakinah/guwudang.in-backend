<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cpartner',
        'id_user',
        'transaction_date',
    ];

    public function partner(){
        return $this->belongsTo(Partner::class, 'id_partner'. 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user'. 'id');
    }
}
