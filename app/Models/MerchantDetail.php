<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MerchantDetail extends Model
{
    /**
     * @var string
     */
    protected $table = 'merchant_details';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'company_phone',
        'company_email',
        'company_address',
        'document_details',
        'status',
        'deleted_at',
        'passport',
        'license'
    ];

    /**
     * @param $merchant_id
     * @return object
     */
    public static function merchantDetail($merchant_id): object
    {
        // get merchant document
        $user = MerchantDetail::where('user_id', $merchant_id)->first();
        if(isset($user))
            return $user;
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
