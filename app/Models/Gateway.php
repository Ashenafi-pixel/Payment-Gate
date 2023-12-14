<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Gateway extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'currency_name',
        'status',
        'deleted_at',
    ];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Media::class, 'media_able');
    }

    /**
     * @return HasOne
     */
    public function merchantGateway(): HasOne
    {
        return $this->hasOne(MerchantGateway::class)->where('user_id', Auth::id());
    }
}
