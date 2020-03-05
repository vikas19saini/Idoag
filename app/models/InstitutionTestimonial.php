<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class InstitutionTestimonial extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'inst_testimonials';

    protected $fillable = ['institute_name', 'name', 'study', 'image', 'description', 'email', 'status'];

}