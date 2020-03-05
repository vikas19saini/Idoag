<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Problem extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'report_problem';

    protected $fillable = ['user_id', 'post_id','reason', 'message' ,'section', 'admin_comments','status'];

}