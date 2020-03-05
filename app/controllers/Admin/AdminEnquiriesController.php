<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\EnquiryRepositoryInterface;

class AdminEnquiriesController extends \BaseController {
    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $testimonial
     *
     */
    protected $enquiry;


    // listing all testimonials


    /**
     * AdminTestimonialsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, EnquiryRepositoryInterface $enquiry)
    {
        $this->user					= $user;

        $this->enquiry				= $enquiry;


    }

    public function index()
    {
         $enquiries =Enquiry::withTrashed()->get();

        return View::make('admin.enquiries.index')->withEnquiries($enquiries);
    }

    // route to show edit testimonial form
    public function edit($id)
    {
        $enquiry = $this->enquiry->find($id);

        return View::make('admin.enquiries.edit')->withEnquiry($enquiry);
    }

    // method to process update testimonial action
    public function update($id)
    {
        $enquiry = $this->enquiry->find($id);

        $input 	= Input::all();

        $enquiry->fill($input)->save();

        return Redirect::route('admin_enquiries')->withFlashMessage('Enquiry have been successfully updated!');
    }

    // method to do multi actions on all admin users
    public function postAdminEnquiriesActions()
    {
        $enquiry_ids = Input::get('checkall');
        if(Input::has('Trash'))
        {

            $this->enquiry->trash($enquiry_ids);

            return Redirect::back()->withFlashMessage('Selected Enquiries Trashed');

        }

        if(Input::has('Untrash'))
        {

            $enquiry = $this->enquiry->untrash($enquiry_ids);
            
            return Redirect::back()->withFlashMessage('Selected Enquiries Untrashed');
        }

        if(Input::has('Activate'))
        {
            $this->enquiry->activate($enquiry_ids);

            return Redirect::back()->withFlashMessage('Selected Enquiries Status as Read');

        }

        if(Input::has('Deactivate'))
        {
            $this->enquiry->deactivate($enquiry_ids);

            return Redirect::back()->withFlashMessage('Selected Enquiries Status as UnRead');


        }

        return Redirect::back()->withErrorMessage('Select atleast some Enquiry');
    }


    public function getEnquiriesExcelExport()
    {

        $enquiries =Enquiry::withTrashed()->get();

        $enquiries		= array_to_object($enquiries);

        $enquiries 	= json_decode(json_encode($enquiries), true);

        // Exporting to excel sheet
        Excel::create('EnquiriesList', function($excel) use($enquiries) {

            $excel->sheet('Enquiries', function($sheet) use($enquiries) {

                $sheet->fromArray($enquiries);

            });

        })->export('xls');

        return Redirect::back()->withFlashMessage('Enquiries exported as Excel successfully!');

    }


}
