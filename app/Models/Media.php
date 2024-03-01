<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{

    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'url',
        'type',
        'media_able_id',
        'media_able_type',
    ];
}
