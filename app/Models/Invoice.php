<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\InvoiceDetail;
class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function payment(){
        return $this->belongsTo(Payment::class,'id','invoice_id');
        
    }
    public function invoice_detail(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
        
    }
}
