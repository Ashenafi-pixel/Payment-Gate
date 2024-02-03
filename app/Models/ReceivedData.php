<?php

// app/Models/ReceivedData.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedData extends Model
{
    use HasFactory;

    protected $table = 'received_data';

    protected $fillable = ['data', 'message'];
}
