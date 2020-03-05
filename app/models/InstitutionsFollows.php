<?php

class InstitutionsFollows extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'institutions_follows';

    protected $fillable = ['institution_id', 'user_id'];



}