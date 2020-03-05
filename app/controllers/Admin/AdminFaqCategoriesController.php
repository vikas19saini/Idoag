<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\FaqCategoryRepositoryInterface;
use idoag\Repos\FaqRepositoryInterface;

class AdminFaqCategoriesController extends \BaseController {


    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $brand
     *
     */
    protected $faq;

    /**
     * @var $category
     *
     */
    protected $category;

    /**
     * @var $adminNewBrandForm
     *
     */


    /**
     * AdminBrandsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, FaqCategoryRepositoryInterface $category, FaqRepositoryInterface $faq)
    {
        $this->user					= $user;

        $this->faq			    	= $faq;

        $this->category				= $category;

 
    }

    // method to list all the categories
    public function index()
    {
        $categories = FaqCategory::withTrashed()->get();

        return View::make('admin.faq_categories.index')->withCategories($categories);

    }

    // method to show category creation form
    public function create()
    {
        return View::make('admin.faq_categories.create');
    }

    // method to process category creation
    public function store()
    {
        $input 	= Input::all();

        $slug 	= Str::slug(Input::get('name'));

        $input 	= array_add($input, 'status', 1);

        $this->category->create($input);

        return Redirect::back()->withFlashMessage('A new category added successfully!');

    }

    // method to show category updaiton form
    public function edit($id)
    {
        $category = $this->category->find($id);

        return View::make('admin.faq_categories.edit')->withCategory($category);
    }

    // method to process category updation form
    public function update($id)
    {
        $category 	= $this->category->find($id);

        $input 		= Input::all();

        $category->fill($input)->save();

        return Redirect::back()->withFlashMessage('category updated successfully!');
    }

    // method to do multi actions on selected categories
    public function postAdminFaqCategoriesActions()
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