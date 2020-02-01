<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 3.11.2019
 * Time: 00:07
 */

namespace ReferralPanda\OpenCoupon\Events;

use Illuminate\Queue\SerializesModels;
use ReferralPanda\OpenCoupon\Models\Coupon;

class CouponRedeemed
{
    use SerializesModels;

    public $user;

    public $coupon;

    public function __construct($user, Coupon $coupon)
    {
        $this->user = $user;
        $this->coupon = $coupon;
    }
}