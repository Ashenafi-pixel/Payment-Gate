<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'symbol'
    ];

}
