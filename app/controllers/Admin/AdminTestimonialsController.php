<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\TestimonialRepositoryInterface;
use idoag\Forms\adminNewTestimonialForm;

class AdminTestimonialsController extends \BaseController {
 /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $testimonial
     *
     */
    protected $testimonial;
    /**
     * @var $adminNewTestimonialForm
     *
     */
    protected $adminNewTestimonialForm;
	
	 /**
     * AdminTestimonialsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, TestimonialRepositoryInterface $testimonial, adminNewTestimonialForm $adminNewTestimonialForm)
    {
        $this->user					= $user;

        $this->testimonial				= $testimonial;

        $this->adminNewTestimonialForm	= $adminNewTestimonialForm;

    }

    // listing all testimonials
    public function index()
    {
        $testimonials = Testimonial::withTrashed()->get();

        return View::make('admin.testimonials.index')->withTestimonials($testimonials);
    }

    // route to start testimonial creation
    public function create()
    {
        return View::make('admin.testimonials.create');
    }

    // route to process testimonial creation
    public function store()
    {
        $input = Input::except('image');

        try
        {
            $this->adminNewTestimonialForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }



        if(Input::hasFile('image'))
        {
            $file = Input::file('image');

            $rules 		= array('file' => 'required|image|max:10240');

            $validator 	= Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){

                $filename = Str::lower(

                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );

                $file->move('uploads/testimonials', $filename);

                $destination 	= public_path() .'/uploads/testimonials/';

                $image 			= IImage::make(sprintf('uploads/testimonials/%s', $filename));

                $image->save($destination.$filename);

                $input['image'] = $filename;


            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }

        $this->testimonial->create($input);

        return Redirect::route('admin_testimonials')->withFlashMessage('Testimonial have been successfully created!');
    }

    // route to show edit testimonial form
    public function edit($id)
    {
        $testimonial = $this->testimonial->find($id);

        return View::make('admin.testimonials.edit')->withTestimonial($testimonial);
    }

    // method to process update testimonial action
    public function update($id)
    {
        $testimonial = $this->testimonial->find($id);

        $input = Input::except('image');


        try
        {
            $this->adminNewTestimonialForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        if(Input::hasFile('image'))
        {
            $file = Input::file('image');

            $rules 		= array('file' => 'required|image|max:10240');

            $validator 	= Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){

                $filename = Str::lower(

                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );

                $file->move('uploads/testimonials', $filename);

                $destination 	= public_path() .'/uploads/testimonials/';

                $image 			= IImage::make(sprintf('uploads/testimonials/%s', $filename));

                $image->save($destination.$filename);

                $input['image'] = $filename;


            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }

        $testimonial->fill($input)->save();

        return Redirect::route('admin_testimonials')->withFlashMessage('Testimonial have been successfully updated!');

    }

    // method to do multi actions on all admin users
    public function postAdminTestimonialsActions()
    {
        if(Input::has('Activate'))
        {
            $testimonial_ids = Input::get('checkall');

            $this->testimonial->activate($testimonial_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Activated');

        }

        if(Input::has('Deactivate'))
        {
            $testimonial_ids = Input::get('checkall');

            $this->testimonial->deactivate($testimonial_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Deactivated');

        }

        if(Input::has('Trash'))
        {
            $testimonial_ids = Input::get('checkall');

            $this->testimonial->trash($testimonial_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Trashed');

        }

        if(Input::has('Untrash'))
        {
            $testimonial_ids = Input::get('checkall');

            $this->testimonial->untrash($testimonial_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Untrashed');

        }

        return Redirect::back()->withErrorMessage('Select atleast some testimonial');
    }



}
