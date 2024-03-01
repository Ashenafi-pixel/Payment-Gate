<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerTransactions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'transaction_id',
      'sender_id',
      'receiver_id',
      'remaining_balance',
      'reason',
      'from_account',
      'payment_type'
    ];
}
