<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class BrandRegistrations extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'brand_registrations';

    protected $fillable = ['brand_name', 'website', 'category', 'name', 'designation', 'email', 'mobile','comments','status'];

}