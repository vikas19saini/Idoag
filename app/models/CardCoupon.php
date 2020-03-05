<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CardCoupon extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'card_coupons';

    protected $fillable = ['name','code','type','value','user_id','status'];

}