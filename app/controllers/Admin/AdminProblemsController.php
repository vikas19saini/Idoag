<?php
use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\ProblemRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;

class AdminProblemsController extends \BaseController {
    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $testimonial
     *
     */
    protected $problem;

    protected $post;


    // listing all testimonials


    /**
     * AdminTestimonialsController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, ProblemRepositoryInterface $problem, PostRepositoryInterface $post)
    {
        $this->user					= $user;

        $this->problem				= $problem;

        $this->post                 = $post;

    }

    public function index()
    {
        $problems =Problem::withTrashed()->get();

        return View::make('admin.problems.index')->withProblems($problems);
    }

    public function edit($id)
    {
        $problem= $this->problem->find($id);
        $user=Sentry::getUser();
        $post=$this->post->find($problem->post_id);

        return View::make('admin.problems.edit', compact('problem','user','post'));
    }

    public function update($id)
    {
        $problem = $this->problem->find($id);

        $input 	= Input::all();

        $problem->fill($input)->save();

        return Redirect::route('admin_problems')->withFlashMessage('Report Problem have been successfully updated!');
    }

    // method to do multi actions on all admin users
    public function postAdminProblemsActions()
    {
        if(Input::has('Trash'))
        {
            $problem_ids = Input::get('checkall');

            $this->problem->trash($problem_ids);

            return Redirect::back()->withFlashMessage('Selected Report Problems Trashed');

        }

        if(Input::has('Untrash'))
        {
            $problem_ids = Input::get('checkall');

           $this->problem->untrash($problem_ids);
            
            return Redirect::back()->withFlashMessage('Selected Report Problems Untrashed');

        }
        if(Input::has('Activate'))
        {
            $problem_ids = Input::get('checkall');

            $this->problem->activate($problem_ids);

            return Redirect::back()->withFlashMessage('Selected Report Problems Activated');

        }

        if(Input::has('Deactivate'))
        {
            $problem_ids = Input::get('checkall');

            $this->problem->deactivate($problem_ids);

            return Redirect::back()->withFlashMessage('Selected Report Problems Deactivated');

        }

        return Redirect::back()->withErrorMessage('Select atleast some Report Problem');
    }


    public function getProblemsExcelExport()
    {

        $problems =Problem::withTrashed()->get();

        $problems		= array_to_object($problems);

        $problems 	= json_decode(json_encode($problems), true);

        dd($problems);

        // Exporting to excel sheet
        Excel::create('ReportProblemsList', function($excel) use($problems) {

            $excel->sheet('ReportProblems', function($sheet) use($problems) {

                $sheet->fromArray($problems);

            });

        })->export('xls');

        return Redirect::back()->withFlashMessage('Report Problems exported as Excel successfully!');

    }


}
