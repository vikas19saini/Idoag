<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRegistrationRepositoryInterface;

class AdminBrandRegistrationsController extends \BaseController {
    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $testimonial
     *
     */
    protected $registration;


    // listing all testimonials


    /**
     * AdminTestimonialsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, BrandRegistrationRepositoryInterface $registration)
    {
        $this->user					= $user;

        $this->registration				= $registration;


    }

    public function index()
    {
        $registrations =BrandRegistrations::withTrashed()->get();

        return View::make('admin.brand_registrations.index')->withRegistrations($registrations);
    }

    public function edit($id)
    {
        $registration= $this->registration->find($id);

        return View::make('admin.brand_registrations.edit')->withRegistration($registration);
    }

    // method to process update testimonial action
    public function update($id)
    {
        $registration = $this->registration->find($id);

        $input 	= Input::all();

        $registration->fill($input)->save();

        return Redirect::route('admin_brand_registrations')->withFlashMessage('Registration has been successfully updated!');
    }

    // method to do multi actions on all admin users
    public function postAdminBrandRegistrationsActions()
    {
        if(Input::has('Activate'))
        {
            $reg_ids = Input::get('checkall');

            $this->registration->activate($reg_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Activated');

        }

        if(Input::has('Deactivate'))
        {
            $reg_ids = Input::get('checkall');

            $this->registration->deactivate($reg_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Deactivated');

        }

        if(Input::has('Trash'))
        {
            $registration_ids = Input::get('checkall');

            $this->registration->trash($registration_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Trashed');

        }

        if(Input::has('Untrash'))
        {
            $registration_ids = Input::get('checkall');

            $this->registration->untrash($registration_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Untrashed');

        }

        return Redirect::back()->withErrorMessage('Select atleast some Registration');
    }


    public function getBrandRegistrationsExcelExport()
    {

        $registrations =BrandRegistrations::withTrashed()->get();

        $registrations		= array_to_object($registrations);

        $registrations 	= json_decode(json_encode($registrations), true);

        // Exporting to excel sheet
        Excel::create('BrandRegistrations', function($excel) use($registrations) {

            $excel->sheet('Registrations', function($sheet) use($registrations) {

                $sheet->fromArray($registrations);

            });

        })->export('xls');

        return Redirect::back()->withFlashMessage('Registrations exported as Excel successfully!');

    }


}
