<?php

namespace App\Models;

use App\Dispatchers\MailEventsDispatcher;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable, HasRoles, MailEventsDispatcher;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'mobile_number',
        'is_verified',
        'is_first_time',
        'phone_otp',
        'email_otp',
        'email_verified_token',
        'is_school',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function merchantDetail(): HasOne
    {
        return $this->hasOne(MerchantDetail::class, 'user_id');
    }

    /**
     * @return HasOne
     */
    public function customerDetail(): HasOne
    {
        return $this->hasOne(CustomerDetail::class, 'user_id');
    }

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Media::class, 'media_able');
    }

    /**
     * calling the accessor of Status
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(strtolower(str_replace('_', ' ', $value))),
        );
    }

    /**
     * @return bool
     */
    public function IS_SCHOOL(): bool
    {
        return $this->is_school == true ? true : false;
    }

    /**
     * @return BelongsTo
     */
    public function Transaction(): HasMany
    {
        return $this->hasMany(Transaction::class,'customer_id');
    }

    /**
     * @return HasMany
     */
    public function merchantCustomer(): HasMany
    {
        return $this->hasMany(MerchantCustomer::class);
    }

    /**
     * @return HasMany
     */
    public function merchantStudent(): HasMany
    {
        return $this->hasMany(MerchantStudent::class);
    }

    /**
     * @return HasMany
     */
    public function merchantGateway(): HasMany
    {
        return $this->hasMany(MerchantGateway::class);
    }

    /**
     * @return HasMany
     */
    public function merchantInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'merchant_id');
    }

    /**
     * @return HasMany
     */
    public function merchantGateways(): HasMany
    {
        return $this->hasMany(MerchantGateway::class);
    }

    /**
     * @param $merchant
     * @return bool
     */
    public static function IS_GATEWAY_INSTALLED($merchant = null): bool
    {
        $user = $merchant ?? auth()->user();
        if (isset($user->merchantGateways) && count($user->merchantGateways) > 0)
            return true;
        else
            return false;
    }

    /**
     * @return HasManyThrough
     */
    public function merchantTransactions():HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Invoice::class,'merchant_id');
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }
}

