<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 2.11.2019
 * Time: 21:56
 */

namespace ReferralPanda\OpenCoupon\Exceptions;


use ReferralPanda\OpenCoupon\Models\Coupon;

class CouponIsNotActive extends \Exception
{
    protected $message = "The coupon is not active/expired.";
    protected $coupon;

    public static function create( $coupon)
    {
        return new static($coupon);
    }

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
}