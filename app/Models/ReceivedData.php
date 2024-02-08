<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedData extends Model
{
    use HasFactory;

    protected $table = 'merchant_orders';

    protected $fillable = ['name', 'amount', 'email', 'tx_ref', 'currency', 'first_name', 'last_name', 'order_detail', 'message'];

    protected $casts = [
        'order_detail' => 'array',
    ];
}
