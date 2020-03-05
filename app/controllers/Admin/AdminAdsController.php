<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\AdRepositoryInterface;
use idoag\Forms\adminNewAdForm;

class AdminAdsController extends \BaseController {
    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $ad
     *
     */
    protected $ad;
    /**
     * @var $adminNewAdForm
     *
     */
    protected $adminNewAdForm;

    /**
     * AdminAdsController  Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, AdRepositoryInterface $ad, adminNewAdForm $adminNewAdForm)
    {
        $this->user				= $user;

        $this->ad				= $ad;

        $this->adminNewAdForm	= $adminNewAdForm;

    }

    // listing all ads
    public function index()
    {
        $ads = Ad::withTrashed()->get(); //echo"<pre>";print_r($ads);exit();

        return View::make('admin.ads.index')->withAds($ads); 
    }

    // route to start ad creation
    public function create()
    {
        return View::make('admin.ads.create');
    }

    // route to process ad creation
    public function store()
    {
        $input = Input::all();

        try
        {
            $this->adminNewAdForm->validate($input);

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

                $file->move('uploads/ads', $filename);

                $destination 	= public_path() .'/uploads/ads/';

                $image 			= IImage::make(sprintf('uploads/ads/%s', $filename));

                $image->save($destination.$filename);

                $input['image'] = $filename;


            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }

        $this->ad->create($input);


        return Redirect::route('admin_ads')->withFlashMessage('Ad have been successfully created!');
    }

    // route to show edit ad form
    public function edit($id)
    {
        $ad = $this->ad->find($id);

        return View::make('admin.ads.edit')->withAd($ad);
    }

    // method to process update ad action
    public function update($id)
    {
        $ad = $this->ad->find($id);

        $input = Input::except('image');



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

                $file->move('uploads/ads', $filename);

                $destination 	= public_path() .'/uploads/ads/';

                $image 			= IImage::make(sprintf('uploads/ads/%s', $filename));

                $image->save($destination.$filename);

                $input['image'] = $filename;


            }else {

                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);

            }

        }

        $ad->fill($input)->save();

        return Redirect::route('admin_ads')->withFlashMessage('Ad have been successfully updated!');

    }

    // method to do multi actions on all admin users
    public function postAdminAdsActions()
    {

        if(Input::has('Activate'))
        {
            $ad_ids = Input::get('checkall');

            $this->ad->activate($ad_ids);

            return Redirect::back()->withFlashMessage('Selected Ads Activated');

        }

        if(Input::has('Deactivate'))
        {
            $ad_ids = Input::get('checkall');

            $this->ad->deactivate($ad_ids);

            return Redirect::back()->withFlashMessage('Selected Ads Deactivated');

        }

        if(Input::has('Trash'))
        {
            $ad_ids = Input::get('checkall');

            $this->ad->trash($ad_ids);

            return Redirect::back()->withFlashMessage('Selected Ads Trashed');

        }

        if(Input::has('Untrash'))
        {
            $ad_ids = Input::get('checkall');

            $this->ad->untrash($ad_ids);

            return Redirect::back()->withFlashMessage('Selected Ads Untrashed');

        }

        return Redirect::back()->withErrorMessage('Select atleast some ad');
    }



}
