<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 2.11.2019
 * Time: 21:56
 */

namespace ReferralPanda\OpenCoupon\Exceptions;

class CouponAlreadyRedeemed extends \Exception
{
    protected $code;

    public static function withCode(string $code)
    {
        return new static('The provided code ' . $code . ' is invalid.', $code);
    }

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCouponCode()
    {
        return $this->code;
    }
}