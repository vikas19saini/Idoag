<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Student\CouponRepositoryInterface;
use idoag\Forms\NewOffersForm;
use idoag\Forms\NewLinksForm;
use idoag\Forms\NewPhotosForm;
use idoag\Forms\NewInternshipsForm;
use idoag\Forms\NewEventsForm;

class InstPostsController extends \BaseController {


    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $brand
     *
     */
    protected $institution;

    /**
     * @var $post
     *
     */
    protected $post;

    protected $offerForm;

    private $user_id;
    private $coupon;

    /**
     * PagesController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user,  InstitutionRepositoryInterface $institution,
                           PostRepositoryInterface $post,
                                NewOffersForm $offerForm, NewEventsForm $newEventsForm, NewInternshipsForm $NewInternshipsForm, NewLinksForm $NewLinksForm, NewPhotosForm $NewPhotosForm, CouponRepositoryInterface $coupon)
    {

        $this->user_id  = Sentry::getUser()->id;

        $this->user		= $user;

        $this->institution 	= $institution;

        $this->post 	= $post;

        $this->coupon   = $coupon;

        $this->offerForm = $offerForm;

        $this->NewEventsForm = $newEventsForm;

        $this->NewLinksForm	= $NewLinksForm;

        $this->NewPhotosForm	= $NewPhotosForm;

        $this->NewInternshipsForm = $NewInternshipsForm;

        cloudinary();

    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

    // sample excel for Coupons


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


        $institution_id = Sentry::getUser()->institution_id;

        $user_id=Sentry::getUser()->id;

        $institution_slug=getInstitutionSlug($institution_id);


        if(Input::has('insphoto'))
        {

           $input = Input::only('size','name','description','short_description');

            try
            {
                $this->NewPhotosForm->validate($input);



            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input 	= array_add($input, 'status', 1);

            $input 	= array_add($input, 'user_id', $this->user_id);

            $input 	= array_add($input, 'institution_id', $institution_id);

            $input = array_add($input, 'type', Input::get('insphoto'));

              if(Input::hasFile('image')) {
                //upload the offer image and save the to database
                $image = Input::file('image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {

                    $destinationPath = public_path() . '/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "S_" . $filename);

                }

               $input = array_add($input, 'image', $filename);
            }
 
            $post_info = $this->post->create($input);

             return Redirect::route('get_inst_photos', array($institution_slug))->withFlashMessage('New Photo has been added');
   
        }

        if(Input::has('instext'))
        {
            $input = Input::only('name','description');

            try
            {
                $this->NewLinksForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input 	= array_add($input, 'status', 1);

            $input  = array_add($input, 'user_id', $this->user_id);

            $input  = array_add($input, 'institution_id', $institution_id);

            $input  = array_add($input, 'type', Input::get('instext'));

            $this->post->create($input);

            return Redirect::route('get_inst_links', array($institution_slug))->withFlashMessage('Your text has been posted');
        }

        if( Input::has('insevent') )
        {
            $size  = Input::get('size');
            $input = Input::only('size','name','description','short_description','isfree','time_from','time_to','registration_url','state','city','contact_details');
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

            try
            {
                $this->NewEventsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }



            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);

            $input = array_add($input, 'type', Input::get('insevent'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'user_id', $user_id);
            $input = array_add($input, 'institution_id', $institution_id);

            if(Input::hasFile('event_image')) {
                //upload the offer image and save the to database
                $image = Input::file('event_image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {

                    $destinationPath = public_path() . '/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "S_" . $filename);

                }

                $input = array_add($input, 'image', $filename);
            }

            $this->post->create($input);


            return Redirect::route('get_inst_events', array($institution_slug))->withFlashMessage('New Event has been added');

        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $posts = $this->post->find($id);
        $input = Input::all();
        $institution_slug=getInstitutionSlug($posts->institution_id);

        if(Input::has('instext'))
        {
            $rules = [
                'name'			=> 'required',
                'description' 	=> 'required'
            ];

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);
            
            $input = array_add($input, 'slug', $slug);

            $validator = Validator::make($input,$rules);

            if($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            else {
                $posts->fill($input)->save();
                return Redirect::route('get_inst_links', array($institution_slug))->withFlashMessage('Your post has been updated');
            }
        }

          if(Input::has('insphoto'))
        {
            $input = Input::except('image');

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);
            
            $input = array_add($input, 'slug', $slug);


            try
            {
                $this->NewPhotosForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            if(Input::hasFile('image'))
            {
                $image              = Input::file('image');

                $destinationPath    = 'uploads/photos';

                $size=Input::get('size');

                $filename           = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if($image->move($destinationPath, $filename))
                {
                    $filename = $filename;
                    $destination = public_path() .'/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
}
                 $input = array_add($input, 'image', $filename);

             }
            dd($input);

            $posts->fill($input)->save();
            return Redirect::route('get_inst_photos', array($institution_slug))->withFlashMessage('Photo has been updated');

        }


        if(Input::has('insevent'))
        {
            $input = Input::only('size','name','description','short_description','isfree','start_date','end_date','time_from','time_to','registration_url','state','city','contact_details');

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);
            
            $input = array_add($input, 'slug', $slug);

            try
            {
                $this->NewEventsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            if(Input::hasFile('event_image'))
            {
                $image			 	= Input::file('event_image');

                $size=Input::get('size');

                $destinationPath 	= 'uploads/photos';

                $filename 			= time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if($image->move($destinationPath, $filename))
                {
                    $filename = $filename;
                    $destinationPath = public_path() .'/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "S_" . $filename);


                }

                $input = array_add($input, 'image', $filename);
            }

            $posts->fill($input)->save();
            return Redirect::route('get_inst_events', array($institution_slug))->withFlashMessage('Event has been updated');

        }

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        Post::destroy($id);
        return Redirect::back()->withFlashMessage('Post has been deleted successfully.');
    }


}
