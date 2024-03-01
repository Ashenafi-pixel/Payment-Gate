<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @var MerchantCustomer
 * @author Shaarif<m.shaarif@xintsolutions.com>
 */

class MerchantCustomer extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
      'user_id',
      'name',
      'email',
      'status',
      'mobile_number',
    ];

    /**
     * @return BelongsTo
     */
    public function merchant():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function customerInvoices():HasMany
    {
        return $this->hasMany(Invoice::class,'customer_id');
    }

    /**
     * @return HasOne
     */
    public function recurringInvoice(): HasOne
    {
        return $this->hasOne(CustomerRecurringInvoices::class,'customer_id');
    }
}
