<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\PincodeRepositoryInterface;

class AdminPincodeController extends \BaseController {
    /**
     * @var $user
     *
     */
    protected $user;
    protected $pincode;


    function __construct(UserRepositoryInterface $user, PincodeRepositoryInterface $pincode)
    {
        $this->user					= $user;

        $this->pincode				= $pincode;

    }

    public function index()
    {
        $pincodes=$this->pincode->getAll();

        return View::make('admin.pincodes.index')->withPincodes($pincodes);
    }


    // method to do multi actions on all admin users
    public function postAdminProblemsActions()
    {
        if(Input::has('Trash'))
        {
            $pincode_ids = Input::get('checkall');

            $this->pincode->trash($pincode_ids);

            return Redirect::back()->withFlashMessage('Selected Pincodes Trashed');
        }

        return Redirect::back()->withErrorMessage('Select atleast some Pincode');
    }


}
