<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\PageRepositoryInterface;
use idoag\Forms\adminNewPageForm;

class AdminPagesController extends \BaseController {

	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $page
	 *
	 */
	protected $page;
	/**
	 * @var $adminNewPageForm 
	 *
	 */
	protected $adminNewPageForm;
	
	/**
	 * AdminPagesController Constructor function 
	 * 
	 */
	 function __construct(UserRepositoryInterface $user, PageRepositoryInterface $page, adminNewPageForm $adminNewPageForm)
	 {
		$this->user					= $user;
		
		$this->page				= $page;
		
		$this->adminNewPageForm	= $adminNewPageForm;
		
		}
	 
	// listing all pages
	public function index()
	{
		$pages = Page::withTrashed()->get();

		return View::make('admin.pages.index')->withPages($pages);
	}

	// route to start page creation
	public function create()
	{
		return View::make('admin.pages.create');
	}

	// route to process page creation
	public function store()
	{
		$input = Input::all();
		
		try 
		{
			$this->adminNewPageForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

        $slug 	= Str::slug(Input::get('heading'));
        $input 	= array_add($input, 'slug', $slug);

		$this->page->create($input);
			
		return Redirect::route('admin_pages')->withFlashMessage('Page have been successfully created!');
	}

	// route to show edit page form
	public function edit($id)
	{
		$page = $this->page->find($id);
		
		return View::make('admin.pages.edit')->withPage($page);
	}

	// method to process update page action
	public function update($id)
	{
		$page = $this->page->find($id);
		
		$input 	= Input::all();
		
		try 
		{
			$this->adminNewPageForm->validate($input);

		} catch (\Laracasts\Validation\FormValidationException $e) {
			
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		 
		
		$page->fill($input)->save();
			
		return Redirect::route('admin_pages')->withFlashMessage('Page have been successfully updated!');
		
	}
	
	// method to do multi actions on all admin users
	public function postAdminPagesActions()
	{

		
		if(Input::has('Trash'))
		{
			$page_ids = Input::get('checkall');
			
			$this->page->trash($page_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Pages Trashed');
			
		}
		
		if(Input::has('Untrash'))
		{
			$page_ids = Input::get('checkall');
			
			$this->page->untrash($page_ids);	
			
			return Redirect::back()->withFlashMessage('Selected Pages Untrashed');
			
		}
		
		return Redirect::back()->withErrorMessage('Select atleast some page');
	} 
	 
}