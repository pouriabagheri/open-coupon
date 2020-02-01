<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 2.11.2019
 * Time: 23:57
 */

namespace ReferralPanda\OpenCoupon\Facades;

use Illuminate\Support\Facades\Facade;

class Coupon extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'coupon';
    }
}