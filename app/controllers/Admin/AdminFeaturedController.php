<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\Post\BrandRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Forms\NewLinksForm;

class AdminFeaturedController extends \BaseController {
	
	/**
	 * @var $links
	 *
	 */
	protected $post;

	protected $brand;

	protected $institution;
	
	/**
	 * @var $newLinksForm
	 *
	 */
	protected $newLinksForm; 
	
	
	function __construct(PostRepositoryInterface $post, NewLinksForm $newLinksForm)
	{
		$this->post 			= $post;

		//, BrandRepositoryInterface $brand, InstitutionRepositoryInterface $institution
		// $this->brand            = $brand;

		// $this->institution      = $institution;
		
		$this->newLinksForm 	=  $newLinksForm;
		
		}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
    	$featured_posts = $this->post->getFeatured(); //echo "<pre>";print_r($featured);exit();

		return View::make('admin.featured.index')->withFeaturedPosts($featured_posts);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function AddFeatured()
	{
		$brands = Brand::orderBy('name')->lists('name', 'id');;  

		$institutions = Institution::orderBy('name')->lists('name', 'id');;  

		$featured_posts =  new \Illuminate\Database\Eloquent\Collection; 

		$param=array('brand_id'=>'','institution_id'=>'','type'=>'');
 
		return View::make('admin.featured.add')->withBrands($brands)->withInstitutions($institutions)->withFeaturedPosts($featured_posts)->withParam($param);

	}

	public function searchFeatured()
	{
		$input=Input::all(); 
		$param=array();

		$brands = Brand::orderBy('name')->lists('name', 'id');;  

		$institutions = Institution::orderBy('name')->lists('name', 'id');;  

		if($input['brand_id']!='')
			$param=array_add($param,'brand_id',$input['brand_id']);

		if($input['institution_id']!='')
			$param=array_add($param,'institution_id',$input['institution_id']);

		if($input['type']!='')
			$param=array_add($param,'type',$input['type']);

		$featured_posts= Post::where($param)->get();

		if($input['type']=='')
			$param=array_add($param,'type','');

		if($input['institution_id']=='')
			$param=array_add($param,'institution_id','');

		if($input['brand_id']=='')
			$param=array_add($param,'brand_id','');
		// dd($featured_posts);

		return View::make('admin.featured.add')->withBrands($brands)->withInstitutions($institutions)->withFeaturedPosts($featured_posts)->withParam($param);
	}

	
public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

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
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

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
	
	public function featuredDeactivate($id)
	{
    	$post 		= $this->post->find($id);

 		if($post->featured == 1)
		{
 			$post->featured  = 0;
			$post->save();
		}

    	$featured_posts 	= $this->post->getFeatured(); //echo "<pre>";print_r($featured);exit();

		return View::make('admin.featured.index')->withFeaturedPosts($featured_posts);
	}

	public function featuredActivate($id)
	{
    	$post 		= $this->post->find($id);

		if($post->featured == 0)
		{
			$post->featured  = 1;

			$post->save();
		}

		 return Redirect::route('admin_featured')->withFlashMessage('Post changed to Featured');
  
 	}

	public function postAdminFeaturedActions()
	{

	}


}
