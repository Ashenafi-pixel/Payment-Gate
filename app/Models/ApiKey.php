<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;
    protected $table = 'api_keys';
    protected $fillable = ['api_key','private_key','public_key','is_enabled','is_production','service'];
    protected $casts = [
        'service' => 'array',
    ];
    public function merchantDetail(){
        return $this->belongsTo(MerchantDetail::class);
    }
}
