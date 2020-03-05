<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Testimonial extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'testimonials';

    protected $fillable = ['company_name', 'website', 'name', 'designation', 'image', 'description', 'email', 'status'];

}