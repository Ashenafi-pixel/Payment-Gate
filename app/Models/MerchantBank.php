<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantBank extends Model
{
    use SoftDeletes;
    protected $table = 'merchant_bank';

    // Define any additional relationships or customizations for the model
}
