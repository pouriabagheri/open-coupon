<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $couponTable = config('open_coupon.coupons_table', 'coupons');
        $redemptionTable = config('open_coupon.coupon_redemption_table', 'coupon_redemption');

        Schema::create($couponTable, function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64)->unique();
            $table->string('couponable_type');
            $table->unsignedInteger('couponable_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('count')->nullable();
            $table->text('data')->nullable();
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
            $table->timestamps();
        });

        Schema::create($redemptionTable, function (Blueprint $table) use ($couponTable) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('coupon_id');
            $table->timestamp('redeemed_at');

            $table->foreign('coupon_id')->references('id')->on($couponTable);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $couponTable = config('open_coupon.coupons_table', 'coupons');
        $redemptionTable = config('open_coupon.coupon_redemption_table', 'coupon_redemption');

        Schema::dropIfExists($couponTable);
        Schema::dropIfExists($redemptionTable);
    }
}
