<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Forms\NewPhotosForm;

class AdminPhotosController extends \BaseController {
	
	/**
	 * @var $photos
	 *
	 */
	protected $post;
	
	/**
	 * @var $newPhotosForm
	 *
	 */
	protected $newPhotosForm; 
	
	
	function __construct(PostRepositoryInterface $post, NewPhotosForm $newPhotosForm)
	{
		$this->post				= $post;
		
		$this->newPhotosForm 	=  $newPhotosForm;

        cloudinary();
		
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $type = 'photo';

        $photos = Post::withTrashed()->where('type',$type)->orderBy('created_at','desc')->get();

		return View::make('admin.brands.photos.index')->withPhotos($photos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$brands = Brand::orderBy('id')->lists('name', 'id'); 

		return View::make('admin.brands.photos.create')->withBrands($brands);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Input::has('photo'))
        {

            $input = Input::except('image');

            try
            {
                $this->newPhotosForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            if(!Input::hasFile('image'))
            {
                return Redirect::back()->withInput()->withErrorMessage('Picture is required.');
            }

            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);

            $input 	= array_add($input, 'status', 1);

            $input 	= array_add($input, 'user_id', Sentry::getUser()->id);

            $input = array_add($input, 'type', Input::get('photo'));

            $image			 	= Input::file('image');

            $destinationPath 	= public_path().'/uploads/photos/';

            $filename 			= time().$image->getClientOriginalName();

            if($image->move($destinationPath, $filename))
            {
                $filename = $filename;
            }

            $input = array_add($input, 'image', $filename);
                
            $this->post->create($input);


            return Redirect::route('admin_photos')->withFlashMessage('Photos have been successfully created!');

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
		$photo 		= $this->post->find($id);
        $brands = Brand::orderBy('id')->lists('name', 'id');
        return View::make('admin.brands.photos.edit')->withPhoto($photo)->withBrands($brands);
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
		$photo 		= $this->post->find($id);
			
		$input 		= Input::only('brand_id','size','name','description','short_description');
								
		try 
		{
			$this->newPhotosForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		if($photo->name!=Input::get('name'))
        {
            $slug 	= Str::slug(Input::get('name'));

            $slug 	= $this->post->getSlug($slug);

            $input 	= array_add($input, 'slug', $slug);
        }


		if(Input::hasFile('image'))
		{
			$image = Input::file('image');
			
			$destinationPath 	= 'uploads/photos';
			 
			$filename 			= time().$image->getClientOriginalName();
		
			if($image->move($destinationPath, $filename))
			{
				$filename = $filename;
			}
			
			$input = array_add($input, 'image', $filename); 
			
		}
		
 		$photo->fill($input)->save();

		return Redirect::route('admin_photos')->withFlashMessage('Photo have been successfully updated!');
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
	public function postAdminPhotosActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$photos = Input::get('checkall');
			
			$this->post->activate($photos);
			
			return Redirect::back()->withFlashMessage('Selected photos Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$photos = Input::get('checkall');
			
			$this->post->deactivate($photos);
			
			return Redirect::back()->withFlashMessage('Selected photos Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$photos = Input::get('checkall');
			
			$this->post->trash($photos);
			
			return Redirect::back()->withFlashMessage('Selected photos Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$photos = Input::get('checkall');
			
			$this->post->untrash($photos);
			
			return Redirect::back()->withFlashMessage('Selected photos Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some photos');
	}


	// public function resizeAllPhotos()
	// {
	// 	$directory = 'uploads/production/uploads/originals';

	// 	$files = File::allFiles($directory);

	// 	foreach ($files as $file)
	// 	{
	// 	$s=explode('\\',$file);
	// 	$filename=$s[1];


	// 	$destination = 'uploads/production/uploads/originals/resized/';

	// 	$image = IImage::make(sprintf($directory . '/%s', $filename))->resize(905, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "FSW_" . $filename);
	// 	$image = IImage::make(sprintf($directory . '/%s', $filename))->resize(452, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "M_" . $filename);
	// 	$image = IImage::make(sprintf($directory . '/%s', $filename))->resize(219, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "S_" . $filename);
	// 	echo $filename.'<br>';
	// 	// exit();
	// 	}
	// }

}
