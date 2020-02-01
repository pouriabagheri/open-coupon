<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 2.11.2019
 * Time: 22:21
 */

namespace ReferralPanda\OpenCoupon\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReferralPanda\OpenCoupon\Exceptions\CouponIsInvalid;
use ReferralPanda\OpenCoupon\Exceptions\CouponIsNotActive;

class Coupon implements Rule
{
    protected $isInvalid = false;
    protected $isNotActive = false;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $coupon = \ReferralPanda\OpenCoupon\Models\Coupon::check($value);
        } catch (CouponIsInvalid $exception) {
            $this->isInvalid = true;
            return false;
        } catch (CouponIsNotActive $exception) {
            $this->isNotActive = true;
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        if ($this->isNotActive) {
            return trans('coupon::validation.code_not_active');
        }
        return trans('coupon::validation.code_invalid');
    }
}