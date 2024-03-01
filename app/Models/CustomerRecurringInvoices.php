<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRecurringInvoices extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'invoice_id',
        'recurring_days'
    ];
}
