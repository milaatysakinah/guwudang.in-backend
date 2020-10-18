<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'user_id',
        'status_invoice_id',
    ];

    public function partner(){
        return $this->belongsTo(Customer::class, 'partner_id'. 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'. 'id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_invoices_id'. 'id');
    }
}
