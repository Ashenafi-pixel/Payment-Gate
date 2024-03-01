<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefundRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_no',
        'reason',
        'otp',
        'is_verified',
        'status',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'id','invoice_no');
    }
}
