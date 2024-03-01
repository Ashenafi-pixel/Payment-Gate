<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'swift_code',
    ];

    /**
     * Get all of the bankServices for the Banks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bankServices(): HasMany
    {
        return $this->hasMany(BankService::class, 'banks_id', 'id');
    }
}
