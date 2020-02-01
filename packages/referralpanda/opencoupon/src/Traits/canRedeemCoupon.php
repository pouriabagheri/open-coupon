<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 2.11.2019
 * Time: 22:05
 */

namespace ReferralPanda\OpenCoupon\Traits;

use ReferralPanda\OpenCoupon\Events\CouponRedeemed;
use ReferralPanda\OpenCoupon\Exceptions\CouponIsNotActive;
use ReferralPanda\OpenCoupon\Models\Coupon;

trait canRedeemCoupon
{


    public function redeemCode(string $code)
    {
        $coupon = Coupon::check($code);

        if (!$coupon->isActive()) {
            throw CouponIsNotActive::create($coupon);
        }
        $this->coupons()->attach($coupon, [
            'redeemed_at' => now()
        ]);

        event(new CouponRedeemed($this, $coupon));
        return $coupon;
    }

    public function redeemCoupon(Coupon $coupon)
    {
        return $this->redeemCode($coupon->code);
    }


    public function coupons()
    {
        return $this->belongsToMany(Coupon::class,
            config('open_coupon.coupon_redemption_table', 'coupon_redemption'))->withPivot('redeemed_at');
    }
}