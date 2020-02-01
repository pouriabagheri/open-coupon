<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ReferralPanda\OpenCoupon\Traits\hasCoupon;

class Item extends Model
{
    use hasCoupon;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
    ];

}
