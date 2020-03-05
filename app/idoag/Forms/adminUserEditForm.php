<?php namespace idoag\Forms;

use Laracasts\Validation\FormValidator;

class AdminUserEditForm extends FormValidator {

  /**
   * @var array
   */
  protected $rules =
    [
    	'email' 		=> 'required|email|unique:users',
		'first_name'	=> 'required',
		'last_name' 	=> 'required',
		'mobile' 		=> 'required',
		'import_students' => 'sometimes|boolean',
		'manage_categories' => 'sometimes|boolean',
		'manage_institutions' => 'sometimes|boolean',
		'manage_brands' => 'sometimes|boolean',
		'manage_offers' => 'sometimes|boolean',
		'brand_users' => 'sometimes|boolean',
		'manage_vouchers' => 'sometimes|boolean',
		'manage_pincode' => 'sometimes|boolean',
		'manage_advertisements' => 'sometimes|boolean',
		'manage_testimonials' => 'sometimes|boolean',
		'activated' => 'sometimes|boolean'
    ];

  /**
   * @param int $id
   */
  public function excludeUserId($id)
  {
    	$this->rules['email'] = "required|email|unique:users,email,$id";

    	return $this;
  }

}


