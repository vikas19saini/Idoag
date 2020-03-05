<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FaqCategory extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'faq_categories';

    protected $fillable = ['name', 'orderno', 'status'];
    
    public function Faqs() {
        
        return $this->hasMany('Faq','cat_id');
    }

}