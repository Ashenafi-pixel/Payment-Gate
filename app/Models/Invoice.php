<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
      'merchant_id',
      'customer_id',
      'student_id',
      'amount',
      'purpose',
      'order_id',
      'status'
    ];

    /**
     * @return mixed
     */
    public function merchant():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function customer():BelongsTo
    {
        return $this->belongsTo(MerchantCustomer::class,'customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function student():BelongsTo
    {
        return  $this->belongsTo(MerchantStudent::class,'student_id');
    }

    /**
     * @return HasOne
     */
    public function invoiceTransaction():HasOne
    {
        return  $this->hasOne(Transaction::class);
    }

    /**
     * @return HasMany
     */
    public function invoiceTransactions()
    {
        return $this->hasMany(Transaction::class)->where('is_refund',1);
    }
}
