<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SliderRepositoryInterface;
use idoag\Repos\PressRepositoryInterface;
use idoag\Forms\adminNewSliderForm;

class AdminSlidersController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $slider 
	 *
	 */
	protected $slider;

	/**
	 * @var $adminNewSliderForm 
	 *
	 */
	protected $adminNewSliderForm;
	
	/**
	 * AdminSlidersController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, SliderRepositoryInterface $slider, adminNewSliderForm $adminNewSliderForm)
	 {
		$this->user					= $user;
		
		$this->slider				= $slider;
		
		$this->adminNewSliderForm	= $adminNewSliderForm;
		
		}
	 
	// listing all sliders
	public function index()
	{
		$sliders = Slider::withTrashed()->get();

		return View::make('admin.sliders.index')->withSliders($sliders);
	}

	// route to start slider creation
	public function create()
	{
		return View::make('admin.sliders.create');
	}

	// route to process slider creation
	public function store()
	{
		$input = Input::only('name', 'link', 'title', 'page_name','priority','target', 'text_color');
		
		try 
		{
			$this->adminNewSliderForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		if(Input::hasFile('image_name'))
		{
			$file = Input::file('image_name');
					
			// validating each file.
			$rules 		= array('file' => 'required|mimes:mp4,png,jpg,jpeg|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = time().Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
								
				$file->move('uploads', $filename);
				
                                if(in_array($file->getClientOriginalExtension(), array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'))){
                                    $destionation 	= public_path() .'/uploads/';				
                                    $image = IImage::make(sprintf('uploads/%s', $filename));				
                                    $image->save($destionation.$filename);
                                }					
				$input['image_name'] = $filename;

				if(Input::hasFile('image_mobile'))				{

					$file = Input::file('image_mobile');

					// validating each file.
					$rules 		= array('file' => 'required|mimes:mp4,png,jpg,jpeg|max:10240'); 							
				  
					$validator 	= Validator::make(array('file'=> $file), $rules);
				  
					if($validator->passes()){

						$filename1 = 'm_' . time().Str::lower(				
                                                            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                                                            .'.'
                                                            .$file->getClientOriginalExtension()
                                                    );
										
						$file->move('uploads', $filename1);
						if(in_array($file->getClientOriginalExtension(), array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'))){
                                                    $destionation 	= public_path() .'/uploads/';						
                                                    $image = IImage::make(sprintf('uploads/%s', $filename1));						
                                                    $image->save($destionation.$filename1);
                                                }
                                                $input['mobile_image'] = $filename1;
																																				
					}					
				}					
																			
			}else {
											
				return Redirect::back()->withInput()->withErrors($validator);										
			}			
		}	
		
		$this->slider->create($input);
			
		return Redirect::route('admin_sliders')->withFlashMessage('Slider have been successfully created!');
	}

	// route to show edit slider form
	public function edit($id)
	{
		$slider = $this->slider->find($id);
		
		return View::make('admin.sliders.edit')->withSlider($slider);
	}

	// method to process update slider action
	public function update($id)
	{
		$slider = $this->slider->find($id);
		
		$input = Input::only('name', 'link', 'title', 'page_name','priority','target', 'text_color');
		
		try 
		{
			$this->adminNewSliderForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		if(Input::hasFile('image_name'))
		{   
			$file = Input::file('image_name');
					
			// validating each file.
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				$filename = time().Str::lower(
				
					pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
					.'.'
					.$file->getClientOriginalExtension()
				);
								
				$file->move('uploads', $filename);
				
				$destionation 	= public_path() .'/uploads/';
				
				$image 			= IImage::make(sprintf('uploads/%s', $filename));
				
				$image->save($destionation.$filename);
													
				$input['image_name'] = $filename;				
																			
			}
			else 
			{
				return Redirect::back()->withInput()->withErrors($validator);												
                        }

		if(Input::hasFile('image_mobile'))
		{
			$file = Input::file('image_mobile');

			// validating each file.
			$rules 		= array('file' => 'required|image|max:10240'); 							
		  
			$validator 	= Validator::make(array('file'=> $file), $rules);
		  
			if($validator->passes()){

				if($input['image_name'])
					$filename1 =  'm_'.$input['image_name'];
				
				else
					$filename1 =  'm_'.$slider['image_name'];

				$file->move('uploads', $filename1);
				
				$destionation 	= public_path() .'/uploads/';
				
				$image = IImage::make(sprintf('uploads/%s', $filename1));
				
				$image->save($destionation.$filename1);
                                
                                $input['mobile_image'] = $filename1;
																																		
			}
		}
		else
		{
			$destionation 	= public_path() .'/uploads/';

			if(Input::hasFile('image_name'))
			{
				if(File::exists($destionation.'m_'.$slider['image_name']))
				{
					rename($destionation.'m_'.$slider['image_name'], $destionation.'m_'.$input['image_name']);
				}
			}
		}
		
		}
		
		$slider->fill($input)->save();
			
		return Redirect::route('admin_sliders')->withFlashMessage('Slider have been successfully updated!');
		
	}
	
	// method to do multi actions on all admin users
	public function postAdminSlidersActions()
	{
		
		if(Input::has('Activate'))
        {
            $slider_ids = Input::get('checkall');

            $this->slider->activate($slider_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Activated');

        }

        if(Input::has('Deactivate'))
        {
            $slider_ids = Input::get('checkall');

            $this->slider->deactivate($slider_ids);

            return Redirect::back()->withFlashMessage('Selected Testimonials Deactivated');

        }

        
		if(Input::has('Trash'))
		{
			$slider_ids = Input::get('checkall');
			
			$this->slider->trash($slider_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Sliders Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$slider_ids = Input::get('checkall');
			
			$this->slider->untrash($slider_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Sliders Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some slider');
	}
	
	// method to export all the sliders into an excel sheet
	public function getSliderExcelExport()
	{
		$sliders 	= $this->slider->getAll();
		
		$sliders 	= array_to_object($sliders);
		
		$sliders 	= json_decode(json_encode($sliders), true);
		
		// Exporting to excel sheet							 
		Excel::create('SlidersList', function($excel) use($sliders) {
		
			$excel->sheet('Sliders', function($sheet) use($sliders) {
		
				$sheet->fromArray($sliders);
		
			});
		
		})->export('xls');
		
		return Redirect::back()->withFlashMessage('Sliders exported as Excel successfully!');
	}

	// method to import sliders from an excel sheet
	public function postSliderExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/sliderslist.xls', function($reader) {
			
			$results = $reader->select(array('page_name', 'name', 'title', 'image_name', 'delete_at'))->get();
			
			foreach($results as $result)
			{
				if($result->name)
				{
					$slider = $this->slider->findByName($result->name);
					
					if($slider)
					{
						
						try
						{
							$input = array('page_name' => $result->page_name, 'name' => $result->name, 'title' => $result->title);
							
							if($result->image_name)
							{
								$input['image_name'] = $result->image_name;
							}
							
							if($result->delete_at)
							{
								$input['delete_at'] = $result->delete_at;
							}
							
							$slider->fill($input)->save();
							
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
						
					} else {
						
						try
						{
							$input = array('page_name' => $result->page_name, 'name' => $result->name, 'title' => $result->title);
							
							if($result->image_name)
							{
								$input['image_name'] = $result->image_name;
							}
							
							if($result->delete_at)
							{
								$input['delete_at'] = $result->delete_at;
							}
							
							$this->slider->create($input);
							
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
					}
				}
			}
			
		});
		
		return Redirect::back()->withFlashMessage('Sliders Imported Successfully!');
	}

	public function getPress()
	{
		return "true";
	}
}