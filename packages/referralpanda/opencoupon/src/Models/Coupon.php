<?php

namespace ReferralPanda\OpenCoupon\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use ReferralPanda\OpenCoupon\Exceptions\CouponIsInvalid;
use ReferralPanda\OpenCoupon\Exceptions\CouponIsNotActive;

class Coupon extends Model
{

    protected $fillable = [
        'couponable_id',
        'couponable_type',
        'users_id',
        'code',
        'data',
        'valid_from',
        'valid_to',
    ];

    protected $casts = [
        'data' => 'collection'
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('open_coupon.coupons_table', 'coupons');
    }


    public function couponable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsToMany(config('open_coupon.user_model'), config('open_coupon.coupon_redemption_table'))->withPivot('redeemed_at');
    }

    public function isActive()
    {
        if (isset($this->valid_from) && isset($this->valid_to)) {
            return Carbon::now()->between($this->valid_from, $this->valid_to, true);
        } else if (isset($this->valid_from)) {
            return Carbon::now()->gte($this->valid_from);
        } else if (isset($this->valid_to)) {
            return Carbon::now()->lte($this->valid_to);
        }
        return true;
    }

    public static function check(string $code)
    {
        $coupon = Coupon::whereCode($code)->first();
        if ($coupon === null) {
            throw CouponIsInvalid::withCode($code);
        }
        if (!$coupon->isActive()) {
            throw CouponIsNotActive::create($coupon);
        }
        return $coupon;
    }

}
