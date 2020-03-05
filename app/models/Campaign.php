<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Campaign extends \Eloquent {
 
 /**
  * The database table used by the model.
  *
  * @var string
  */
 use SoftDeletingTrait;
 protected $table = 'campaign';
 protected $dates = ['created_at'];
 
 protected $fillable = ['name', 'email', 'college', 'contact', 'social', 'link'];
 

}

