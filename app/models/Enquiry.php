<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Enquiry extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'enquiries';

    protected $fillable = ['firstname', 'lastname', 'phone', 'email', 'message', 'comments', 'status'];

}