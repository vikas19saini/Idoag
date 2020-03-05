<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Faq extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $table = 'faqs';

    protected $fillable = ['question', 'answer', 'orderno', 'cat_id', 'status'];

    public function FaqCategory() {
        
        return $this->hasOne('FaqCategory','','');
    }

}