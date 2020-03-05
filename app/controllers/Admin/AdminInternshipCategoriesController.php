<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\InternshipCategoryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Forms\adminNewCategoryForm;

class AdminInternshipCategoriesController extends \BaseController {


	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $brand 
	 *
	 */
	protected $brand;
	
	/**
	 * @var $category 
	 *
	 */
	protected $category;
	
	/**
	 * @var $adminNewBrandForm 
	 *
	 */
	protected $adminNewBrandForm;
	
	/**
	 * AdminBrandsController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, InternshipCategoryRepositoryInterface $category, adminNewCategoryForm $adminNewCategoryForm, BrandRepositoryInterface $brand)
	 {
		$this->user					= $user;
		
		$this->brand				= $brand;
		
		$this->category				= $category;
		
		$this->adminNewCategoryForm	= $adminNewCategoryForm;
		
		}
	 
	// method to list all the categories
	public function index()
	{
		$categories = InternshipCategory::withTrashed()->get();
		
		return View::make('admin.internship_categories.index')->withCategories($categories);
		
	}
	
	// method to show category creation form
	public function create()
	{
		return View::make('admin.internship_categories.create');
	}

	// method to process category creation
	public function store()
	{		
		$input 	= Input::all();
		
		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->category->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', 1);
		
		try 
		{
			$this->adminNewCategoryForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		$this->category->create($input);
		
		return Redirect::back()->withFlashMessage('A new category added successfully!');
		
	}
	
	// method to show category updaiton form
	public function edit($id)
	{
		$category = $this->category->find($id);
		
		return View::make('admin.internship_categories.edit')->withCategory($category);
	}

	// method to process category updation form
	public function update($id)
	{
		$category 	= $this->category->find($id);
		
		$oldslug	= $category->slug;
		
		$input 		= Input::all();
		
		$slug 		= Str::slug(Input::get('name'));
		
		$slug 		= $this->category->getSlug($slug);
				
		$input 		= array_add($input, 'slug', $slug);
		
		$input 		= array_add($input, 'status', 1);
				
		try 
		{
			$this->adminNewCategoryForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		
		$category->fill($input)->save();
		
		DB::transaction(function() use ($input, $category, $oldslug)
       	{
			$brands	= 	$this->brand->findByCategory($oldslug);
			
			//echo "<pre>";print_r($brands);exit;
			
			foreach($brands as $brand)
			{
				//echo "<pre>";print_r($brand->category);exit;
				
				$categories = explode(",", $brand->category);
				
				foreach($categories as $key => $cat)
				{
					//echo "<pre>";print_r($brand->category);exit;
					
					if($cat == $oldslug)
					{
						$categories[$key] = $category->slug;
					}
				}
				
				$brand->category = implode(",", $categories);
				
				$brand->save();
			}
		});
		
		return Redirect::back()->withFlashMessage('category updated successfully!');
	}
	
	// route to export all categories data as an excel sheet
	public function getCategoriesExcelExport()
	{
		
		$categories = $this->category->getAll();
		
		$categories	= array_to_object($categories);
		
		$categories = json_decode(json_encode($categories), true);
		
		// Exporting to excel sheet							 
		Excel::create('CategoriesList', function($excel) use($categories) {
		
			$excel->sheet('Categories', function($sheet) use($categories) {
		
				$sheet->fromArray($categories);
		
			});
		
		})->export('xls');

		
		return Redirect::back()->withFlashMessage('Categories exported as Excel successfully!');
	 
	}
	
	// method to import all categories data from an excel sheet
	public function postCategoriesExcelImport()
	{
		$file 		= Input::file('file');
		$filename 	= Str::lower(
						pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
						.'.'
						.$file->getClientOriginalExtension()
					);
						
		$file->move('imports', $filename);
		
		Excel::load('imports/categorieslist.xls', function($reader) {
			
			$results = $reader->select(array('name', 'description', 'status'))->get();
			
			foreach($results as $result)
			{
				if($result->name)
				{
											
					$category 	= $this->category->findByName($result->name);
					
					$oldslug	= $category->slug;
					
					if($category)
					{
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->category->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'status' => $result->status);
							
							$category->fill($input)->save();
							
							DB::transaction(function() use ($category, $oldslug)
							{
								$brands	= 	$this->brand->findByCategory($oldslug);
																
								foreach($brands as $brand)
								{									
									$categories = explode(",", $brand->category);
									
									foreach($categories as $key => $cat)
									{										
										if($cat == $oldslug)
										{
											$categories[$key] = $category->slug;
										}
									}
									
									$brand->category = implode(",", $categories);
									
									$brand->save();
								}
							});
		
							$category->save();	
							
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
						
					} else { 
						
						try
						{
							$slug 		= Str::slug($result->name);
		
							$slug 		= $this->category->getSlug($slug);
		
							$input = array('name' => $result->name, 'description' => $result->description, 'slug' => $slug, 'status' => $result->status);
							
							$this->category->create($input);
											
						} catch(\Illuminate\Database\QueryException $e)
						{
							Log::error($e);
	
							return 'Sorry! Something is wrong';
						}
					
					}
				}
			}
			
		});
		
		return Redirect::back()->withFlashMessage('Categories Imported Successfully');
		
	}
	
	// method to do multi actions on selected categories
	public function postAdminInternshipCategoriesActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$categories = Input::get('checkall');
			
			$this->category->activate($categories);	
			
			return Redirect::back()->withFlashMessage('Admin categories Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$categories = Input::get('checkall');
			
			$this->category->deactivate($categories);	
			
			return Redirect::back()->withFlashMessage('Admin categories Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$categories = Input::get('checkall');
			
			$this->category->trash($categories);	
			
			return Redirect::back()->withFlashMessage('Admin categories Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$categories = Input::get('checkall');
			
			$this->category->untrash($categories);	
			
			return Redirect::back()->withFlashMessage('Admin categories Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some categories');
	}

}