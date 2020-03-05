<?php

use idoag\Repos\Post\PostRepositoryInterface;


class AdminPopupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /adminpopup
	 *
	 * @return Response
	 */
	public function index()
	{
		$popups = Popup::orderBy('updated_at','desc')->get();

		return View::make('admin.popup.index')->withPopups($popups);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /adminpopup/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.popup.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /adminpopup
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('name','url','start_date','end_date','status');

		if(Input::get('status') == '')
		{
			$input['status'] = 0;
		}
		// echo"<pre>";print_r($input);exit();

		if(Input::hasfile('image'))
		{
            $image              = Input::file('image');

            $destinationPath    = 'uploads/popup_images';

            $filename           = time() . $image->getClientOriginalName();

			$filename			= str_replace(' ','_',$filename);
			
            if ($image->move($destinationPath, $filename)) {
            	
            	$destination 	= 'uploads/popup_images/';

                $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(650, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "pop_" . $filename);
            }

            $input 				= array_add($input, 'image', $filename);          
		}

		$popup_create = Popup::create($input);

		if($popup_create)
			return Redirect::back()->withFlashMessage('Pop-up has been created Succesfully.');
		else
			return Redirect::back()->withErrorMessage('Sorry!! Could not create the Pop-up');
	}

	/**
	 * Display the specified resource.
	 * GET /adminpopup/{id}
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
	 * GET /adminpopup/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$popup = Popup::find($id);

		return View::make('admin.popup.edit')->withPopup($popup);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /adminpopup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::only('name','url','start_date','end_date','status');

		if(Input::get('status') == '')
		{
			$input['status'] = 0;
		}

		// echo"<pre>";print_r($input['status']);exit();

		if(Input::hasfile('image'))
		{
            $image              = Input::file('image');

            $destinationPath    = 'uploads/popup_images';

            $filename           = time() . $image->getClientOriginalName();

			$filename			= str_replace(' ','_',$filename);
			
            if ($image->move($destinationPath, $filename)) {
            	
            	$destination 	= 'uploads/popup_images/';

                $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(650, null, function ($constraint) { $constraint->aspectRatio(); })->save($destination . "pop_" . $filename);
            }

            $input 				= array_add($input, 'image', $filename);          
		}

		$popup_update = Popup::where('id',$id)->update($input);

		if($popup_update)
			return Redirect::back()->withFlashMessage('Pop-up has been updated Succesfully.');
		else
			return Redirect::back()->withErrorMessage('Sorry!! Could not update the Pop-up');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /adminpopup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function postAdminPopupActions()
	{		
		$popups = Input::get('checkall');
		// echo "<pre>";print_r($popups);exit;

		if(!empty($popups))
		{
			if(Input::has('Activate'))
			{
				
				Popup::wherein('id',$popups)->update(array('status'=>1));	
				
				return Redirect::back()->withFlashMessage('Selected Popups Activated');			
			}
			
			if(Input::has('Deactivate'))
			{			
				Popup::wherein('id',$popups)->update(array('status'=>0));	
				
				return Redirect::back()->withFlashMessage('Selected Popups Deactivated');			
			}
			
			if(Input::has('Delete'))
			{			
				Popup::wherein('id',$popups)->delete();	
				
				return Redirect::back()->withFlashMessage('Selected Popups Deleted');			
			}
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some Popups');
	}
}