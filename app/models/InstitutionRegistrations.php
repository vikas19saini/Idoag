<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class InstitutionRegistrations extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'institution_registrations';

    protected $fillable = ['inst_name', 'website', 'state','city', 'name', 'designation', 'email', 'mobile','comments','status'];

}