<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\FaqRepositoryInterface;
use idoag\Forms\adminNewFAQForm;
use idoag\Repos\FaqCategoryRepositoryInterface;

class AdminFaqsController extends \BaseController {

    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $faq
     *
     */
    protected $faq;
    /**
     * @var $adminNewFaqForm
     *
     */
    protected $adminNewFaqForm;

    protected $category;

    /**
     * AdminFaqsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, FaqRepositoryInterface $faq, FaqCategoryRepositoryInterface $category, adminNewFAQForm $adminNewFaqForm)
    {
        $this->user				= $user;

        $this->faq				= $faq;

        $this->adminNewFaqForm	= $adminNewFaqForm;

        $this->category         = $category;

    }

    // listing all faqs
    public function index()
    {
        $faqs = Faq::withTrashed()->get();


        return View::make('admin.faqs.index')->withFaqs($faqs);
    }

    // route to start faq creation
    public function create()
    {
        $categories = $this->category->getList();
        
        return View::make('admin.faqs.create')->withCategories($categories);
    }

    // route to process faq creation
    public function store()
    {
        $input = Input::all();

        try
        {
            $this->adminNewFaqForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $this->faq->create($input);

        return Redirect::route('admin_faqs')->withFlashMessage('Faq have been successfully created!');
    }

    // route to show edit faq form
    public function edit($id)
    {
        $faq = $this->faq->find($id);

        $categories = $this->category->getList();

        return View::make('admin.faqs.edit')->withFaq($faq)->withCategories($categories);
    }

    // method to process update faq action
    public function update($id)
    {
        $faq = $this->faq->find($id);

        $input 	= Input::all();

        try
        {
            $this->adminNewFaqForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }


        $faq->fill($input)->save();

        return Redirect::route('admin_faqs')->withFlashMessage('Faq have been successfully updated!');

    }

    // method to do multi actions on all admin users
    public function postAdminFaqsActions()
    {


        if(Input::has('Trash'))
        {
            $faq_ids = Input::get('checkall');

            $this->faq->trash($faq_ids);

            return Redirect::back()->withFlashMessage('Selected Faqs Trashed');

        }

        if(Input::has('Untrash'))
        {
            $faq_ids = Input::get('checkall');

            $this->faq->untrash($faq_ids);

            return Redirect::back()->withFlashMessage('Selected Faqs Untrashed');

        }

        return Redirect::back()->withErrorMessage('Select atleast some faq');
    }

}