<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\StudentRegistrationRepositoryInterface;

class AdminStudentRegistrationsController extends \BaseController {
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
    function __construct(UserRepositoryInterface $user, StudentRegistrationRepositoryInterface $registration)
    {
        $this->user					= $user;

        $this->registration				= $registration;


    }

    public function index()
    {
        $registrations =StudentRegistrations::withTrashed()->get();

        return View::make('admin.student_registrations.index')->withRegistrations($registrations);
    }

    // route to show edit testimonial form
    public function edit($id)
    {
        $registration = $this->registration->find($id);

        return View::make('admin.student_registrations.edit')->withRegistration($registration);
    }

    // method to process update testimonial action
    public function update($id)
    {
        $registration = $this->registration->find($id);

        $input 	= Input::all();

        $registration->fill($input)->save();

        return Redirect::route('admin_student_registrations')->withFlashMessage('Registration has been successfully updated!');
    }

    // method to do multi actions on all admin users
    public function postAdminStudentRegistrationActions()
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
            $reg_ids = Input::get('checkall');

            $this->registration->trash($reg_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Trashed');

        }

        if(Input::has('Untrash'))
        {
            $reg_ids = Input::get('checkall');

            $this->registration->untrash($reg_ids);

            return Redirect::back()->withFlashMessage('Selected Registrations Untrashed');

        }

        return Redirect::back()->withErrorMessage('Select atleast some Registrations');
    }


    public function getStudentRegistrationsExcelExport()
    {

        $registrations =StudentRegistrations::withTrashed()->get();

        $registrations		= array_to_object($registrations);

        $registrations 	= json_decode(json_encode($registrations), true);

        // Exporting to excel sheet
        Excel::create('StudentRegistrations', function($excel) use($registrations) {

            $excel->sheet('Registrations', function($sheet) use($registrations) {

                $sheet->fromArray($registrations);

            });

        })->export('xls');

        return Redirect::back()->withFlashMessage('Registrations exported as Excel successfully!');

    }


}
