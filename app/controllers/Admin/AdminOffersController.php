<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Post\BrandRepositoryInterface;
use idoag\Forms\adminEditOfferForm;
use idoag\Forms\NewOffersForm;
use idoag\Repos\Student\CouponRepositoryInterface;
use idoag\Repos\Student\UserCouponRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;


class AdminOffersController extends \BaseController {

	protected $post;

    private $coupon;

    private $user_coupon;

    private $outlet;

	protected $adminEditOfferForm; 
	
	
	function __construct(PostRepositoryInterface $post, OutletRepositoryInterface $outlet, adminEditOfferForm $adminEditOfferForm, NewOffersForm $offerForm,  CouponRepositoryInterface $coupon, UserCouponRepositoryInterface $user_coupon,  InstitutionRepositoryInterface $institution)
	{

        $this->user_id  			= Sentry::getUser()->id;

		$this->post 				= $post;

        $this->offerForm 			= $offerForm;
		
		$this->adminEditOfferForm 	=  $adminEditOfferForm;

        $this->coupon   			= $coupon;

        $this->user_coupon   			= $user_coupon;

        $this->institution 			= $institution;

        $this->outlet       		= $outlet;
	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $type = 'offer';

        $offers = Post::withTrashed()->where('type',$type)->orderBy('created_at','desc')->get();

		return View::make('admin.brands.offers.index')->withOffers($offers);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	$brands = Brand::orderBy('id')->lists('name', 'id');

        $institutions = $this->institution->getList();

        return View::make('admin.brands.offers.create')->withBrands($brands)->withInstitutions($institutions);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{			
        if( Input::has('offer') )
        {
            $input = Input::only('brand_id','size','name','short_description','description','web_only','offer_type','voucher_type','panindia', 'for_user_type');

            $offer_type = Input::get('offer_type');

            if($offer_type == 'percentage')
            {
                $input = array_add($input, 'offer_value', Input::get('offer_value1'));
            }

            if($offer_type == 'flat')
            {
                $input = array_add($input, 'offer_value',Input::get('offer_value2'));
            }

		    try
	        {
	            $this->offerForm->validate($input);

	        } catch (\Laracasts\Validation\FormValidationException $e) {

	            return Redirect::back()->withInput()->withErrors($e->getErrors());
	        }

            $web_only = Input::get('web_only');

            if($web_only!=1)
            {
                $panindia = Input::get('panindia');

                if($panindia =='Local')
                {
                    $input = array_add($input, 'state', Input::get('state'));

                    $input = array_add($input, 'city', Input::get('city'));
                }

                if($panindia =='College')
                {
                    $input = array_add($input, 'panindia_inst_id', Input::get('panindia_inst_id'));
                }

            }

            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);


            $input = array_add($input, 'type', Input::get('offer'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'user_id', Sentry::getUser()->id);
            $input = array_add($input, 'brand_id', Input::get('brand_id'));
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

            //upload the offer image and save the to database


            $size        =   Input::get('size');



            if(Input::file('offer_image')) {

                $image              = Input::file('offer_image');

                $destinationPath    = 'uploads/photos';

                $filename           = time() . $image->getClientOriginalName();

                $input = array_add($input, 'image', $filename);

                if ($image->move($destinationPath, $filename)) {

                    $filename = $filename;

                    $destinationPath = public_path() . '/uploads/photos/';

                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "FSW_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "M_" . $filename);
                    $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destinationPath . "S_" . $filename);

                }

                $input = array_add($input, 'image', $filename);
            }


            if(Input::has('featured'))
			{
				$input 	= array_add($input, 'featured', Input::get('featured'));
			}


            $data = $this->post->create($input);

            if(Input::get('voucher_type')=='single')
            {
                $input2=array();
                //code of coupons for single
                $input2 	= array_add($input2, 'code', Input::get('coupon_code'));
                $input2 	= array_add($input2, 'post_id', $data->id);
                $input2 	= array_add($input2, 'type', Input::get('voucher_type'));

                $this->coupon->create($input2);

             }

            if(Input::get('voucher_type')=='multiple' && Input::hasFile('coupon_codes'))
            {
                $type = Input::get('voucher_type');

                //need write as per excel upload
                $file       = Input::file('coupon_codes');

                $filename   = Str::lower(
                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    .'.'
                    .$file->getClientOriginalExtension()
                );	
				
				 $filename=str_replace(' ','_',$filename);

                $file->move('imports', $filename);
				
				 $count=0;

               Excel::selectSheetsByIndex(0)->load('imports/'.$filename, function($reader) use($data , $type, $count) {

                    $results = $reader->select(array('coupons'))->get();

                   
                    foreach($results as $result)
                    {
                        if($result->coupons)
                        {
                            $input = array('post_id' => $data->id, 'type'=>$type , 'code' => $result->coupons);
                            $coupon  = $this->coupon->create($input);
                            $count++;
                        }
                    }

                    if($count==0)
                        return Redirect::back()->withErrorMessage('No Coupons Imported. Check the Sample Excel for format.');
                });

            } 

	        return Redirect::route('admin_offers')->withFlashMessage('Offer has been successfully created!');
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
		$offer 		= $this->post->find($id);

        $cities= City::where('state_id','=',$offer->state)->lists('name', 'id');
        $institutions = $this->institution->getList();

        $brands = Brand::orderBy('id')->lists('name', 'id');

        $coupon   = $this->coupon->getByPostId($id);

        return View::make('admin.brands.offers.edit')->withBrands($brands)->withOffer($offer)->withCities($cities)->withCoupon($coupon)->withInstitutions($institutions);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		//return Input::all();
		$offer 		= $this->post->find($id);
			
		$input 		= Input::except('offer_image','coupon_code','coupon_codes');

		//echo"<pre>";print_r($input);exit();
								
		try 
		{
			$this->adminEditOfferForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		} 
		
		$slug 	= Str::slug(Input::get('name'));

		$slug 	= $this->post->getSlug($slug);

		$input 	= array_add($input, 'slug', $slug);

		$input 	= array_add($input, 'featured', Input::get('featured'));


		if(Input::hasFile('offer_image'))
		{
			$image = Input::file('offer_image');
			
			$destinationPath 	= 'uploads/photos';
			 
			$filename 			= time().$image->getClientOriginalName();
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

        $offer->fill($input)->save();

        if(Input::get('voucher_type')=='single')
        {
            $coupon=$this->coupon->getByPostId($id);
            $input2=array();
            $input2 	= array_add($input2, 'code', Input::get('coupon_code'));
            $coupon->fill($input2)->save();
        }

        if(Input::get('voucher_type')=='multiple' && Input::hasFile('coupon_codes') )
        {
             //need write as per excel upload
            $file       = Input::file('coupon_codes');

            $type = Input::get('voucher_type');
			
			if($file) {
			$count=0;

            $filename   = Str::lower(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                .'.'
                .$file->getClientOriginalExtension()
            );
			 $filename=str_replace(' ','_',$filename);

            $file->move('imports', $filename);

           Excel::selectSheetsByIndex(0)->load('imports/'.$filename, function($reader) use($offer , $type) {

                $results = $reader->select(array('coupons'))->get();
                $count=0;

                foreach($results as $result)
                {
                    if($result->coupons)
                    {
                    $input = array('post_id' => $offer->id, 'type'=>$type , 'code' => $result->coupons);
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
		
		return Redirect::route('admin_offers')->withFlashMessage('Offer has been successfully updated!');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getCouponDetails($id)
    {
        $offer 		= $this->post->find($id);
        if($offer->voucher_type=='single')
             $coupons    = $this->coupon->getByPostId($id);
        else
            $coupons=$this->coupon->getListByPostId($id);
        $coupons_used    = $this->user_coupon->getByPostId($id);
        return View::make('admin.brands.offers.coupon')->withOffer($offer)->withCoupons($coupons)->withCouponsUsed($coupons_used);
    }

    public function postAdminCouponsActions()
    {
        if(Input::has('Trash'))
        {
            $coupons = Input::get('checkall');

            $this->coupon->trash($coupons);

            return Redirect::back()->withFlashMessage('Selected Coupons Trashed');

        }
        return Redirect::back()->withErrorMessage('Select atleast some coupons');

    }

	// method to do multi actions on selected offers
	public function postAdminOffersActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$offers = Input::get('checkall');
			
			$this->post->activate($offers);
			
			return Redirect::back()->withFlashMessage('Selected offers Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$offers = Input::get('checkall');
			
			$this->post->deactivate($offers);
			
			return Redirect::back()->withFlashMessage('Selected offers Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$offers = Input::get('checkall');
			
			$this->post->trash($offers);
			
			return Redirect::back()->withFlashMessage('Selected offers Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$offers = Input::get('checkall');
			
			$this->post->untrash($offers);
			
			return Redirect::back()->withFlashMessage('Selected offers Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some offers');
	}



}
