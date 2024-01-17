<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'swift_code',
    ];
    public function merchants()
    {
        return $this->belongsToMany(merchantDetail::class, 'merchant_bank')
            ->withPivot(['balance', 'account_number'])
            ->withTimestamps();
    }
}
