<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\CategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Student\CouponRepositoryInterface;
use idoag\Forms\NewOffersForm;
use idoag\Forms\NewLinksForm;
use idoag\Forms\NewPhotosForm;
use idoag\Forms\NewInternshipsForm;
use idoag\Forms\NewEventsForm;

class PostsController extends \BaseController {


    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $setting
     *
     */
    protected $setting;

    /**
     * @var $brand
     *
     */
    protected $brand;

    /**
     * @var $post
     *
     */
    protected $post;

    /**
     * @var $post
     *
     */
    protected $offerForm;

    /**
     * @var $post
     *
     */
    private $user_id;


    /**
     * @var $post
     *
     */
    private $coupon;

    /**
     * PagesController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, SettingsRepositoryInterface $setting, BrandRepositoryInterface $brand,
                             CategoryRepositoryInterface $category, PostRepositoryInterface $post,
                                NewOffersForm $offerForm, NewEventsForm $newEventsForm, NewInternshipsForm $NewInternshipsForm, NewLinksForm $NewLinksForm, NewPhotosForm $NewPhotosForm, CouponRepositoryInterface $coupon)
    {
        $this->user_id = Sentry::getUser()->id;

        $this->user		= $user;

        $this->setting 	= $setting;

        $this->brand 	= $brand;

        $this->category	= $category;

        $this->post 	= $post;

        $this->coupon   = $coupon;

        $this->offerForm = $offerForm;

        $this->NewEventsForm = $newEventsForm;

        $this->NewLinksForm	= $NewLinksForm;

        $this->NewPhotosForm	= $NewPhotosForm;

        $this->NewInternshipsForm = $NewInternshipsForm;

        $result 	= $this->setting->getAll();

        //echo "<pre>";print_r($result[0]->logo);exit;

        if(isset($result) && $result)
        {

            $settings 	= $result;

            View::share('settings', $settings);

        }

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
    public function getCouponExport()
    {
        // Exporting to excel sheet                          
        Excel::create('coupons', function($excel){
        
            $excel->sheet('coupon_codes', function($sheet){
        
                $sheet->fromArray(array(
                    array('coupons'),
                    array('IDG-COUPON1'),
                    array('IDG-COUPON2'),
                    array('IDG-COUPON3'),
                    array('IDG-COUPON4'),
                    array('IDG-COUPON5'),
                    array('IDG-COUPON6'),
                    array('IDG-COUPON7'),
                    array('IDG-COUPON8'),
                    array('IDG-COUPON9')
                ), null, 'A1', false, false);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  12,
                        'bold'      =>  true
                    )
                ));  


                $sheet->cells('A2:A10', function($cells) {

                    $cells->setFontSize(10);
                    $cells->setFontWeight('');

                });
            });                             
        
        })->export('xls');
        
        return Redirect::back()->withFlashMessage('Sample Excel exported successfully!');
     
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $user = Sentry::getUser();

        $brand_id=$user->brand_id;

        $brand_slug=getBrandSlug($brand_id);

        if( Input::has('offer') )
        {              
            $input = Input::only('size','name','short_description','description','web_only','offer_type','voucher_type');

            $available_stores = Input::get('available_stores');

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));

            $panindia = Input::get('panindia');
                if($panindia!='')
                $input = array_add($input, 'panindia', Input::get('panindia'));

                if($panindia =='Local' || $panindia=='India')
                {
                    if(Input::get('state')!='')
                    $input = array_add($input, 'state', Input::get('state'));
                    if(Input::get('city')!='')
                    $input = array_add($input, 'city', Input::get('city'));
                }

                if($panindia =='College')
                {
                    $input = array_add($input, 'panindia_inst_id', Input::get('panindia_inst_id'));
                }

                if($available_stores)
                {
                    $input = array_add($input, 'available_stores', implode(',',$available_stores));
                }


            $offer_type = Input::get('offer_type'); 
            


            if($offer_type == 'percentage')
            {
                 $input = array_add($input, 'offer_value', Input::get('offer_value1'));
            }

            if($offer_type == 'flat')
            {
                $input = array_add($input, 'offer_value',Input::get('offer_value2'));
            }
//dd($input);
            try
            {
                $this->offerForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);

            $input = array_add($input, 'type', Input::get('offer'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'user_id', $this->user_id);
            $input = array_add($input, 'brand_id', $brand_id);
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

            //upload the offer image and save the to database            
			
			$size        =   Input::get('size');

            if(Input::file('offer_image')) {

                $image              = Input::file('offer_image');

                $destinationPath    = 'uploads/photos';

                $filename           = time() . $image->getClientOriginalName();
                $filename           = str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {

                    $filename = $filename;
                    $destination = public_path() . '/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input = array_add($input, 'image', $filename);
            }

//  dd($input); 
         $data = $this->post->create($input);

            if(Input::get('voucher_type')=='single')
            {
                //code of coupons for single
                $type = Input::get('voucher_type');

                $code = Input::get('coupon_code');


                //DB::table('coupons')->insert(['code' => $code,'post_id' => $data->id, 'created_at' => date('Y-m-d H:i:s')]);
                $coupon_insert = $this->coupon->create(array('code' => $code,'post_id' => $data->id));
            }

            if(Input::get('voucher_type') == 'multiple' && Input::hasFile('coupon_codes'))
            {
                if(Input::has('voucher_type')) {

                    //need write as per excel upload
                    $file = Input::file('coupon_codes');

                    $filename = Str::lower(
                        pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '.'
                        . $file->getClientOriginalExtension()
                    );
                    $filename=str_replace(' ','_',$filename);


                    $file->move('imports', $filename);

                    $count=0;
					$id=$data->id;
					$type = Input::get('voucher_type');
                    Excel::selectSheetsByIndex(0)->load('imports/' . $filename, function ($reader) use ($id, $type,$count) {                        

                        $results = $reader->select(array('coupons'))->get();					

                        foreach ($results as $result) {

                            if($result->coupons)
                            {
                                $input = array('post_id' => $id, 'type'=>$type , 'code' => $result->coupons);
                                $coupon  = $this->coupon->create($input);
                                $count++;
                            }
					
                        }
                        if($count==0)
                            return Redirect::back()->withErrorMessage('No Coupons Imported. Check the Sample Excel for format.');
                    });
                }
            }
            return Redirect::route('brand_profile', array($brand_slug))->withFlashMessage('Offer has been added');
        
        }

        if( Input::has('internship') )
        {
            $input = Input::only('size','name','skills','short_description','description','category','state','city','offer_type','amount', 'positions','resume_preference', 'question1','question2','question3','question4','question5');

            $size  = Input::get('size');

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));

            try
            {
                $this->NewInternshipsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);

            $input = array_add($input, 'type', Input::get('internship'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'status', 1);
            $input = array_add($input, 'user_id', $this->user_id);
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

            $input = array_add($input, 'brand_id', $brand_id);

            if(Input::hasFile('internship_image')) {

                $image = Input::file('internship_image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {
                    $filename = $filename;
                    $destination = public_path() . '/uploads/photos/';

                      $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input = array_add($input, 'image', $filename);
            }

            $this->post->create($input);

            return Redirect::route('brand_profile', array($brand_slug))->withFlashMessage('Internship has been posted');
       
        }

        if(Input::has('text'))
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

            $input  = array_add($input, 'brand_id', $brand_id);

            $input  = array_add($input, 'type', Input::get('text'));

            $this->post->create($input);

            return Redirect::route('brand_profile', array($brand_slug))->withFlashMessage('Your update has been posted');
       
        }

        if(Input::has('photo'))
        {
            $input = Input::all();

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            $size  = Input::get('size');

            try
            {
                $this->NewPhotosForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input = array_add($input, 'brand_id', $brand_id);

            $input = array_add($input, 'type', Input::get('photo'));

            $input 	= array_add($input, 'status', 1);

            $input 	= array_add($input, 'user_id', $this->user_id);

            if(Input::hasFile('image')) {
                //upload the offer image and save the to database
                $image = Input::file('image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) 
                {                    
                    $destination = public_path() . '/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input['image'] = $filename;
            }

            $post_info = $this->post->create($input);

            return Redirect::route('brand_profile', array($brand_slug))->withFlashMessage('Photo added successfully');
       
        }

        if( Input::has('event') )
        {
            $input = Input::only('size','name','description','short_description','isfree','time_from','time_to','registration_url','state','city','contact_details');
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));
            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            try
            {
                $this->NewEventsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);

            $input = array_add($input, 'type', Input::get('event'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'user_id', $this->user_id);
            $input = array_add($input, 'brand_id', $brand_id);

            if(Input::hasFile('event_image')) {

                //upload the offer image and save the to database
                $image = Input::file('event_image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {

                    $destination = public_path() . '/uploads/photos/';

                     $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input = array_add($input, 'image', $filename);
            }

            $this->post->create($input);

            return Redirect::route('brand_profile', array($brand_slug))->withFlashMessage('New Event has been added');
       
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
    
        $brand_slug=getBrandSlug($posts->brand_id);
    
        $input = Input::all();


        if(Input::has('text'))
        {
            $rules = [
                'name'			=> 'required',
                'description' 	=> 'required',
                'status'		=> 'sometimes|boolean'
            ];
            
            if($posts->name!=Input::get('name'))
            {
            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);
            $input = array_add($input, 'slug', $slug);
            }

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            $validator = Validator::make($input,$rules);

            if($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            else {
                 $posts->fill($input)->save();
                return Redirect::route('get_text', array($brand_slug))->withFlashMessage('Your post has been updated');
            }

        }

        if( Input::has('internship') )
        {
            $input = Input::only('size','name','short_description','description','category','start_date','end_date','state','skills','city','offer_type','amount', 'positions', 'resume_preference', 'question1','question2','question3','question4','question5');

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            if($posts->name!=Input::get('name'))
            {
                $slug = Str::slug(Input::get('name'));
                $slug = $this->post->getSlug($slug);
                $input = array_add($input, 'slug', $slug);
            }
            
            try
            {
                $this->NewInternshipsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }


            if(Input::file('internship_image')) {
                //upload the internship image and save the to database
                $image = Input::file('internship_image');
                $size=Input::get('size');
                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if ($image->move($destinationPath, $filename)) {
                    $filename = $filename;
					$destination = public_path() .'/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input = array_add($input, 'image', $filename);
            }
            $posts->fill($input)->save();
            return Redirect::route('get_internships', array($brand_slug))->withFlashMessage('Internship has been updated');

        }

        if(Input::has('event'))
        {
            $input = Input::only('size','name','description','short_description','isfree','start_date','end_date','time_from','time_to','registration_url','state','city','contact_details');

            if($posts->name!=Input::get('name'))
            {
                $slug = Str::slug(Input::get('name'));
                $slug = $this->post->getSlug($slug);
                $input = array_add($input, 'slug', $slug);
            }

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


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
                    $destination = public_path() .'/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input = array_add($input, 'image', $filename);
            
            }

            $posts->fill($input)->save();
      
            return Redirect::route('get_events', array($brand_slug))->withFlashMessage('Event has been updated');

        }

        if(Input::has('photo'))
        {
            $input = Input::except('image');

            if($posts->name!=Input::get('name'))
            {
                $slug = Str::slug(Input::get('name'));
                $slug = $this->post->getSlug($slug);
                $input = array_add($input, 'slug', $slug);
            }

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            try
            {
                $this->NewPhotosForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            if(Input::hasFile('image'))
            {
                $image			 	= Input::file('image');

                $destinationPath 	= 'uploads/photos';

                $size=Input::get('size');

                $filename 			= time() . $image->getClientOriginalName();
                $filename=str_replace(' ','_',$filename);


                if($image->move($destinationPath, $filename))
                {
                    $filename = $filename;
                    $destination = public_path() .'/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
                }

                $input['image'] = $filename;

            }

            $posts->fill($input)->save();

            return Redirect::route('get_photos', array($brand_slug))->withFlashMessage('Photo has been updated');

        }

        if(Input::has('offer')) {

            $input = Input::only('size', 'name', 'short_description', 'description', 'start_date', 'end_date', 'web_only', 'offer_type', 'voucher_type');

            $web_only = Input::get('web_only');

            $input['description']=str_replace(array("\r\n", "\r", "\n"), "", Input::get('description'));


            $offer_type = Input::get('offer_type');

            if($offer_type == 'percentage')
            {
                $input = array_add($input, 'offer_value', Input::get('offer_value1'));
            }

            if($offer_type == 'flat')
            {
                $input = array_add($input, 'offer_value',Input::get('offer_value2'));
            }

            $panindia = Input::get('panindia');
            if($panindia!='')
            $input = array_add($input, 'panindia', Input::get('panindia'));

            if(Input::get('state')!='')
                $input = array_add($input, 'state', Input::get('state'));
            if(Input::get('city')!='')
                $input = array_add($input, 'city', Input::get('city'));

            if($panindia == 'College')
            {
                $input = array_add($input, 'panindia_inst_id', Input::get('panindia_inst_id'));
            }

            //echo"<pre>";print_r($brand_id);exit();
            $available_stores = Input::get('available_stores');

            if ($available_stores)
                $input['available_stores'] = implode(',', $available_stores);

            try
            {
                $this->offerForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            if($posts->name!=Input::get('name'))
            {
                $slug = Str::slug(Input::get('name'));
                $slug = $this->post->getSlug($slug);
                $input = array_add($input, 'slug', $slug);
            }

            $input = array_add($input, 'type', Input::get('offer'));

            $input = array_add($input, 'user_id', $this->user_id);

            if(Input::hasFile('offer_image'))
            {
                //upload the offer image and save the to database
                $image			 	= Input::file('offer_image');

                $size=Input::get('size');

                $destinationPath 	= 'uploads/photos';

                $filename 			= time() . $image->getClientOriginalName();
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

            $posts->fill($input)->save();

            //  dd($input);

            if(Input::get('voucher_type')=='single')
            {
                $code = Input::get('coupon_code');

                $s=CouponCreateOrUpdate(array('post_id' => $id, 'code' => $code), array('post_id' => $id));

                //DB::table('coupons')->where('post_id', $id)->update(['code' => $code,  'updated_at' => date('Y-m-d H:i:s')]);
            }

            if(Input::get('voucher_type')=='multiple' && Input::hasFile('coupon_codes'))
            {
                $type = Input::get('voucher_type');

                //need write as per excel upload
                $file       = Input::file('coupon_codes');

                if($file) {
                    $filename = Str::lower(
                        pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '.'
                        . $file->getClientOriginalExtension()
                    );
                    $filename=str_replace(' ','_',$filename);


                    $file->move('imports', $filename);
					 
					$count=0;
                    Excel::selectSheetsByIndex(0)->load('imports/' . $filename, function ($reader) use ($id, $type,$count) {                        

                        $results = $reader->select(array('coupons'))->get();
					
						
                        foreach ($results as $result) {

                            if($result->coupons)
                            {
                                $input = array('post_id' => $id, 'type'=>$type , 'code' => $result->coupons);
                                $coupon  = $this->coupon->create($input);
                                $count++;
                            }
					
                        }
                        if($count==0)
                            return Redirect::back()->withErrorMessage('No Coupons Imported. Check the Sample Excel for format.');
						 else
							return Redirect::back()->withFlashMessage('Coupons Imported Successfully');
                    });

                }
            }

            return Redirect::route('get_offers', array($brand_slug))->withFlashMessage('Offer has been updated');

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

    public function changePostStatus()
    {
        $post_id = Input::get('post_id');

        $post=$this->post->find($post_id);

        if($post->status==1)
        {
            $post->status=0;
            $post->save();
            return Response::json(array(
                'message' => 'inactive',
                'post_id' => $post_id));
        }
        else
        {
            $post->status=1;
            $post->save();
            return Response::json(array(
                'message' => 'active',
                'post_id' => $post_id));
        }
 
    }

}
