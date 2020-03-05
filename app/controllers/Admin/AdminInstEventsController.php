<?php
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Forms\adminEditEventForm;
use idoag\Forms\NewEventsForm;

class AdminInstEventsController extends \BaseController {
	
	/**
	 * @var $events
	 *
	 */
	protected $post;
	
	/**
	 * @var $adminEditEventForm
	 *
	 */
	protected $adminEditEventForm; 
	
	
	function __construct(PostRepositoryInterface $post, adminEditEventForm $adminEditEventForm, NewEventsForm $eventForm)
	{
		$this->post 				= $post;

        $this->eventForm 			= $eventForm;
		
		$this->adminEditEventForm 	=  $adminEditEventForm;
		

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $type = 'insevent';

        $events = Post::where('type',$type)->orderBy('created_at','desc')->get();

		return View::make('admin.institutions.events.index')->withEvents($events);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$institutions= Institution::orderBy('id')->lists('name', 'id');

		return View::make('admin.institutions.events.create')->withInstitutions($institutions);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{			
        if( Input::has('insevent') )
        {
            $input = Input::only('institution_id','size','name','description','short_description','isfree','time_from','time_to','registration_url','state','city','contact_details');
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

	        try
	        {
	            $this->eventForm->validate($input);

	        } catch (\Laracasts\Validation\FormValidationException $e) {

	            return Redirect::back()->withInput()->withErrors($e->getErrors());
	        }
	        $slug = Str::slug(Input::get('name'));
	        $slug = $this->post->getSlug($slug);

	        $input = array_add($input, 'type', Input::get('insevent'));
	        $input = array_add($input, 'slug', $slug);
	        $input = array_add($input, 'user_id', Sentry::getUser()->id);
	        $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
	        $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));


            if(Input::file('image')) {


	        //upload the event image and save the to database
	        $image			 	= Input::file('image');

            $destinationPath    = '/uploads/photos';

	        $filename 			= time().$image->getClientOriginalName();

            if ($image->move($destinationPath, $filename)) {

                $filename = $filename;

                $destinationPath = public_path() . '/uploads/photos/';

                $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(905, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . "FSW_" . $filename);
                $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(452, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . "M_" . $filename);
                $image = IImage::make(sprintf($destinationPath . '/%s', $filename))->resize(219, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . "S_" . $filename);

                $input = array_add($input, 'image', $filename);
            }
            }
	        $this->post->create($input);

	        return Redirect::route('admin_inst_events')->withFlashMessage('Event has been successfully created!');
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
		$event 		= $this->post->find($id);
		
		return View::make('admin.institutions.events.edit')->withEvent($event);
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
		$event 		= $this->post->find($id);
			
		$input 		= Input::except('image');
								
		try 
		{
			$this->adminEditEventForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
						
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		} 
		
		$slug 	= Str::slug(Input::get('event_title'));
		
		$slug 	= $this->post->getSlug($slug);
				
		$input 	= array_add($input, 'slug', $slug);
		
		$input 	= array_add($input, 'status', Input::get('status'));
		
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
		
		$event->fill($input)->save();
		
		return Redirect::route('admin_inst_events')->withFlashMessage('Event have been successfully updated!');
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
	
	// method to do multi actions on selected events
	public function postAdminInstEventsActions()
	{
		//echo "<pre>";print_r(Input::all());exit;
		
		if(Input::has('Activate'))
		{
			$events = Input::get('checkall');
			
			$this->post->activate($events);
			
			return Redirect::back()->withFlashMessage('Selected events Activated');
			
		}
		
		if(Input::has('Deactivate'))
		{
			$events = Input::get('checkall');
			
			$this->post->deactivate($events);
			
			return Redirect::back()->withFlashMessage('Selected events Deactivated');
			
		}
		
		if(Input::has('Trash'))
		{
			$events = Input::get('checkall');
			
			$this->post->trash($events);
			
			return Redirect::back()->withFlashMessage('Selected events Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$events = Input::get('checkall');
			
			$this->post->untrash($events);
			
			return Redirect::back()->withFlashMessage('Selected events Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some events');
	}
}
