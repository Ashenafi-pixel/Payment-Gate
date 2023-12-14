<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];

    /**
     * @param $array
     * @return TransactionType
     */
    public static function GET_TRANSACTION_TYPE($array): TransactionType
    {
        return self::where($array)->first();
    }

    /**
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucwords(str_replace('_',' ',$value)),
        );
    }
}
