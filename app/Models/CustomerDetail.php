<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'customer_details';

    protected $fillable = [
        'user_id',
        'balance',
        'document_details',
        'status',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
