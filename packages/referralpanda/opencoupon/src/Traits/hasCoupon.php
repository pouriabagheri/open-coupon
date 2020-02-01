<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 20.10.2019
 * Time: 18:10
 */


namespace ReferralPanda\OpenCoupon\Traits;


use Illuminate\Support\Str;
use ReferralPanda\OpenCoupon\Models\Coupon;

trait hasCoupon
{

    public function coupons()
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }

    public function createCoupon($count = null, $user_id = null, $valid_from = null,  $valid_to = null, array $data = [])
    {
        $code = self::generateCode();

        $coupon = $this->coupons()->create([
            'code' => $code,
            'count' => $count,
            'data' => $data,
            'valid_from' => $valid_from,
            'valid_to' => $valid_to,
            'user_id' => $user_id,
        ]);

        return $coupon;
    }

    protected static function generateCode()
    {
        $length = config('open_coupon.coupon_length', 5);
        $prefix = config('open_coupon.coupon_prefix', '');
        $case = config('open_coupon.coupon_case', 'mixcase');

        do {
            $coupon = Str::random($length);
            switch ($case){
                case 'uppercase':
                    $coupon = strtoupper($coupon);
                    break;
                case 'lowercase':
                    $coupon = strtolower($coupon);
                    break;
            }
            $coupon = $prefix.$coupon;
        } while (Coupon::where('code',$coupon)->exists());

        return $coupon;
    }
}