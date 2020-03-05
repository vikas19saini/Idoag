<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;

class AdminSettingsController extends \BaseController {
	
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
	 * AdminSettingsController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, SettingsRepositoryInterface $setting)
	 {
		$this->user							= $user;
		
		$this->setting 						= $setting;
						
		}
	 
	// method to lsit all the settings
	public function index()
	{
 		$settings = $this->setting->getAll();

 		return View::make('admin.settings.index')->withSettings($settings);
	}

	// method to show settings update form
	public function edit($id)
	{
		$setting 	= $this->setting->find($id); //echo"<pre>";print_r($setting);exit();
		
		return View::make('admin.settings.edit')->withSetting($setting);
		
	}

	// method to process setting updation 
	public function update($id)
	{
		$setting 	= $this->setting->find($id);
		
		$input 		= Input::except('logo');
						
		if (Input::hasFile('logo'))
		{
			$file = Input::file('logo');
					
			// validating each file.
			$rules 		= array('file' => 'required|image|mimes:png|max:5120');							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);

				$filename = 'logo.png';
								
				$file->move('uploads', $filename);
				
				$destionation 	= public_path() .'/uploads/';
				
				$image 			= IImage::make(sprintf('uploads/%s', $filename));
				
				$image->save($destionation.$filename);
									
				$image->resize(100, 38);
				
				$image->save($destionation."th_".$filename);
				
				$input['logo'] 	= $filename;
																			
			}else {
											
				// redirect back with errors.
				return Redirect::back()->withInput()->withErrors($validator);
												
			}
		}
		if(!Input::has('dashboad_popup'))
		$input['dashboad_popup']=0;	
		
  		$setting->fill($input)->save();
				
		return Redirect::back()->withFlashMessage('Settings have been successfully updated!');
					
	}

   
}