<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\PressRepositoryInterface;
use idoag\Forms\adminNewPressForm;

class AdminSliderPressController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $press_sliders 
	 *
	 */
	protected $press_sliders;
	
	/**
	 * @var $adminNewPressForm 
	 *
	 */
	protected $adminNewPressForm;
	
	/**
	 * AdminSliderPressController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, PressRepositoryInterface $press_sliders, adminNewPressForm $adminNewPressForm)
	 {
		$this->user					= $user;
		
		$this->press_sliders		= $press_sliders;
		
		$this->adminNewPressForm	= $adminNewPressForm;
		
		}
	 
	// listing all sliders
	public function index()
	{		
		$press_sliders = Press::orderBY('created_at','desc')->get();//echo "<pre>";print_r($press_sliders);exit();

		return View::make('admin.press.index')->withPressSliders($press_sliders);
	}

	// route to start slider creation
	public function create()
	{
		return View::make('admin.press.create');
	}

	// route to process slider creation

	public function store()
	{
		$input = Input::only('name', 'link', 'description');

		$slug 	= Str::slug(Input::get('name'));

		$input['slug'] = $this->press_sliders->getSlug($slug);

		try 
		{
		$this->adminNewPressForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {

		return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		if(Input::hasFile('image_logo'))
		{
			$file = Input::file('image_logo');

			// validating each file.
			$rules = array('file' => 'required|image|max:10240'); 

			$validator = Validator::make(array('file'=> $file), $rules);

			if($validator->passes()){

			$filename = Str::lower(

			pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
			.'.'
			.$file->getClientOriginalExtension()
			);

			$file->move('uploads/press', $filename);

			$destionation = public_path() .'/uploads/press';

			$image = IImage::make(sprintf('uploads/press/%s', $filename));

			$image->save($destionation.$filename);

			$input['image_logo'] = $filename;

			}else {

			// redirect back with errors.
			return Redirect::back()->withInput()->withErrors($validator);

			}
		}

		if(Input::hasFile('image_news'))
		{
			$file = Input::file('image_news');

			// validating each file.
			$rules = array('file' => 'required|image|max:10240'); 

			$validator = Validator::make(array('file'=> $file), $rules);

			if($validator->passes()){

			$filename = Str::lower(

			pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
			.'.'
			.$file->getClientOriginalExtension()
			);

			$file->move('uploads/press', $filename);

			$destionation = public_path() .'/uploads/press';

			$image = IImage::make(sprintf('uploads/press/%s', $filename));

			$image->save($destionation.$filename);

			$input['image_news'] = $filename;

			}else {

			// redirect back with errors.
			return Redirect::back()->withInput()->withErrors($validator);

			}
		}

		$this->press_sliders->create($input);

		return Redirect::route('admin_sliders_press')->withFlashMessage('News has been successfully created!');
	}

	// route to show edit Press form
	public function edit($id)
	{
		$press = $this->press_sliders->find($id);
		
		return View::make('admin.press.edit')->withPress($press);
	}

	// method to process update Press action
	public function update($id)
	{
		$press_sliders = $this->press_sliders->find($id);

		$slug 	= Str::slug(Input::get('name'));

		$input = Input::only('name', 'link', 'description');

		if(!($press_sliders->name == Input::get('name')))
		{
			$input['slug'] = $this->press_sliders->getSlug($slug); //echo $input['slug'];exit();
		}


		try 
		{
		$this->adminNewPressForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {

		return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		if(Input::hasFile('image_logo'))
		{
			$file = Input::file('image_logo');

			// validating each file.
			$rules = array('file' => 'required|image|max:10240'); 

			$validator = Validator::make(array('file'=> $file), $rules);

			if($validator->passes()){

			$filename = Str::lower(

			pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
			.'.'
			.$file->getClientOriginalExtension()
			);

			$file->move('uploads/press', $filename);

			$destionation = public_path() .'/uploads/press';

			$image = IImage::make(sprintf('uploads/press/%s', $filename));

			$image->save($destionation.$filename);

			$input['image_logo'] = $filename;

			}else {

			// redirect back with errors.
			return Redirect::back()->withInput()->withErrors($validator);

			}
		}

		if(Input::hasFile('image_news'))
		{
			$file = Input::file('image_news');

			// validating each file.
			$rules = array('file' => 'required|image|max:10240'); 

			$validator = Validator::make(array('file'=> $file), $rules);

			if($validator->passes()){

			$filename = Str::lower(

			pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
			.'.'
			.$file->getClientOriginalExtension()
			);

			$file->move('uploads/press', $filename);

			$destionation = public_path() .'/uploads/press';

			$image = IImage::make(sprintf('uploads/press/%s', $filename));

			$image->save($destionation.$filename);

			$input['image_news'] = $filename;

			}else {

			// redirect back with errors.
			return Redirect::back()->withInput()->withErrors($validator);

			}
		}
		
		$press_sliders->fill($input)->save();
			
		return Redirect::route('admin_sliders_press')->withFlashMessage('Slider have been successfully updated!');
		
	}
	
	// method to do multi actions on all admin users
	public function postAdminSliderPressActions()
	{
		
		$press = Input::get('checkall');

		//echo "<pre>"; print_r($press); exit();

		if(Input::has('Activate'))
		{
			$this->press_sliders->activate($press);
			
			return Redirect::back()->withFlashMessage('Selected News Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{			
			$this->press_sliders->deactivate($press);
			
			return Redirect::back()->withFlashMessage('Selected News Deactivated');
			
		}

		if(Input::has('Trash'))
		{			
			$this->press_sliders->trash($press);	
			
			return Redirect::back()->withFlashMessage('Selected News Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			
			$this->press_sliders->untrash($press);	
			
			return Redirect::back()->withFlashMessage('Selected News Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some News');
	}

	public function pressDetailPage($slug)
	{
		$press_single = $this->press_sliders->getBySlug($slug); //echo"<pre>";print_r($press_single);exit();

		return View::make('pages.press_detail')->withPressSingle($press_single);
	}

	public function pressList()
	{
		$press_all = Press::where('activated','=', 1)->orderBy('created_at','desc')->get(); //echo"<pre>";print_r($press);exit();

		return View::make('pages.press_list')->withPressAll($press_all);
	}

}