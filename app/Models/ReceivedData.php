<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedData extends Model
{
    use HasFactory;

    protected $table = 'merchant_orders';

    // protected $fillable = ['merchant_name','merchant_id','tin_number', 'amount', 'email', 'tx_ref', 'currency', 'first_name', 'last_name', 'order_detail', 'message'];
    protected $fillable = ['merchant_name', 'merchant_id', 'tin_number', 'items_list', 'amount', 'email', 'tx_ref', 'currency', 'first_name', 'last_name', 'order_detail', 'message', 'phone_number'];


    protected $casts = [
        'items_list' => 'array',
        'order_detail' => 'array',
    ];
}
