<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Popup extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletingTrait;


    protected $dates = ['deleted_at'];

    protected $table = 'popup';

    protected $fillable = ['name', 'image', 'url' ,'start_date', 'end_date','status'];

}