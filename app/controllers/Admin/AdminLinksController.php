<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Forms\NewLinksForm;

class AdminLinksController extends \BaseController {
	
	/**
	 * @var $links
	 *
	 */
	protected $post;
	
	/**
	 * @var $newLinksForm
	 *
	 */
	protected $newLinksForm; 
	
	
	function __construct(PostRepositoryInterface $post, NewLinksForm $newLinksForm)
	{
		$this->post 			= $post;
		
		$this->newLinksForm 	=  $newLinksForm;
		
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {

        $type = 'text';

        $links = Post::withTrashed()->where('type',$type)->orderBy('created_at','desc')->get();

		return View::make('admin.brands.links.index')->withLinks($links);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$brands = Brand::orderBy('id')->lists('name', 'id');

		return View::make('admin.brands.links.create')->withBrands($brands);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Input::has('text'))
        {
            $input = Input::all();

            try
            {
                $this->newLinksForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input 	= array_add($input, 'status', 1);

            $input 	= array_add($input, 'user_id', Sentry::getUser()->id);

            $input = array_add($input, 'type', Input::get('text'));

            $this->post->create($input);

            return Redirect::route('admin_links')->withFlashMessage('Link have been successfully created!');
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
		$link 		= $this->post->find($id);
		
		return View::make('admin.brands.links.edit')->withlink($link);
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
		$link 		= $this->post->find($id);
		
		$oldlink	= $link->slug;
			
		$input 		= Input::only('name','description','status');
								
		try 
		{
			$this->newLinksForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		} 
		
		$slug 	= Str::slug(Input::get('name'));
		
		$slug 	= $this->post->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', Input::get('status'));
		
		$link->fill($input)->save();
		
		return Redirect::route('admin_links')->withFlashMessage('Link have been successfully updated!');
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
	
	// method to do multi actions on selected offers
	public function postAdminLinksActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$links = Input::get('checkall');
			
			$this->post->activate($links);
			
			return Redirect::back()->withFlashMessage('Selected links Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$links = Input::get('checkall');
			
			$this->post->deactivate($links);
			
			return Redirect::back()->withFlashMessage('Selected links Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$links = Input::get('checkall');
			
			$this->post->trash($links);
			
			return Redirect::back()->withFlashMessage('Selected links Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$links = Input::get('checkall');
			
			$this->post->untrash($links);
			
			return Redirect::back()->withFlashMessage('Selected links Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some links');
	}



}
