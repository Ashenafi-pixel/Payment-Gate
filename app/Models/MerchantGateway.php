<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantGateway extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
      'user_id',
      'gateway_id',
      'status'
    ];

    /**
     * @return BelongsTo
     */
    public function merchant():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function gateway():BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }
}
