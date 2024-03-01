<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyAccounts extends Model
{
    use HasFactory;

    protected $fillable = [
      'account_number',
      'name',
      'email',
      'phone_number'
    ];
}
