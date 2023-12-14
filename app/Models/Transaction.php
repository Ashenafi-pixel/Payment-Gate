<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'gateway_id',
        'transaction_type',
        'invoice_id',
        'debit',
        'credit',
        'status',
        'type',
        'trx_id',
        'payment_response',
        'addispay_commission',
        'refund_type',
        'is_refund'
    ];

    /**
     * @return HasOne
     */
    public function transactionDetail():HasOne
    {
        return $this->hasOne(CustomerTransactions::class);
    }

    /**
     * @return HasOne
     */
    public function transactionType():HasOne
    {
        return  $this->hasOne(TransactionType::class,'id','transaction_type');
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function transactionGateway():BelongsTo
    {
        return $this->belongsTo(Gateway::class,'gateway_id');
    }

    /**
     * @return BelongsTo
     */
    public function transactionInvoice():BelongsTo
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    /**
     * @return Attribute
     */
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(strtolower($value)),
        );
    }

}
