<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Ad extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletingTrait;

    protected $table = 'ads';

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'image', 'status' ,'src', 'expiry_date'];

}