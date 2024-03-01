<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtilityPayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'utility_payments';

    /**
     * @var string[]
     */
    protected $fillable = [
        'transaction_id',
        'manifest_id',
        'bill_id',
        'name',
        'amount_due',
        'due_date',
        'paid_at',
        'response_object'
    ];

    /**
     * @return HasOne
     */
    public function transaction():HasOne
    {
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }
}
