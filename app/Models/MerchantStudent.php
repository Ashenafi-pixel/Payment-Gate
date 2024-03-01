<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantStudent extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
      'user_id',
      'name',
      'father_name',
      'class',
      'section',
      'email',
      'mobile_number',
      'address',
      'status',
    ];

    /**
     * @return BelongsTo
     */
    public function merchant():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
