<?php

use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Forms\adminEditInternshipForm;
use idoag\Forms\NewInternshipsForm;
use idoag\Repos\InternshipCategoryRepositoryInterface;
use idoag\Repos\Institution\InstitutionRepositoryInterface;
use idoag\Repos\Student\StudentInternshipRepositoryInterface;


class AdminInternshipsController extends \BaseController
{

    /**
     * @var $internships
     *
     */
    protected $post;
    protected $internship;


    function __construct(PostRepositoryInterface $post, StudentInternshipRepositoryInterface $internship, BrandRepositoryInterface $brand,  InstitutionRepositoryInterface $institution, InternshipCategoryRepositoryInterface $category, NewInternshipsForm $NewInternshipsForm, adminEditInternshipForm $adminEditInternshipForm)
    {
        $this->post = $post;
        $this->brand = $brand;
        $this->category	= $category;
        $this->internship 	= $internship;

        $this->NewInternshipsForm = $NewInternshipsForm;

        $this->adminEditInternshipForm = $adminEditInternshipForm;
        $this->institution 			= $institution;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {        

        $internships = Post::withTrashed()->where('type', 'internship')->orWhere('type', 'job')->orWhere('type', 'ambassador')->orderBy('created_at','desc')->get();

        return View::make('admin.brands.internships.index')->withInternships($internships);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $brands = Brand::orderBy('id')->lists('name', 'id');
        $categories= $this->category->getList();

        return View::make('admin.brands.internships.create')->withBrands($brands)->withCategories($categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Input::has('internship')) {

            //validate data and add to the internships table
            $input = Input::only('brand_id', 'name','skills','description','category','state','city','offer_type','amount', 'positions','resume_preference', 'question1','question2','question3','question4','question5','application_date');
            try {
                $this->NewInternshipsForm->validate($input);

            } catch (\Laracasts\Validation\FormValidationException $e) {

                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }

            //echo "<pre>";print_r($input);exit();


            $slug = Str::slug(Input::get('name'));
            $slug = $this->post->getSlug($slug);

            $input = array_add($input, 'type', Input::get('internship'));
            $input = array_add($input, 'slug', $slug);
            $input = array_add($input, 'user_id', Sentry::getUser()->id);
            $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
            $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

            if (Input::hasFile('image')) {
                $image = Input::file('image');

                $destinationPath = 'uploads/photos';

                $filename = time() . $image->getClientOriginalName();

                if ($image->move($destinationPath, $filename)) {
                    $filename = $filename;
                }

                $input = array_add($input, 'image', $filename);
            }


            $this->post->create($input);

            return Redirect::route('admin_internships')->withFlashMessage('Internship/job has been successfully created!');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function getApplications()
    {
        $input=array('institution'=>'','brand'=>'','status'=>'','startdate'=>'','enddate'=>'','internship'=>'');
        $brands = $this->brand->getBrandList();
        $institutions = $this->institution->getList();
        $internship_list=$this->post->getPostIdsByType('internship');
        $posts=$this->post->getListByIds($internship_list);
        $internships = Internship::orderBy('created_at','desc')->get();
        return View::make('admin.brands.internships.applications')->withInternships($internships)->withPosts($posts)->withFilter($input)->withBrands($brands)->withInstitutions($institutions);
    }
    public function searchApplications()
    {
        $param=array();
        $brands = $this->brand->getBrandList();
        $internship_list=$this->post->getPostIdsByType('internship');
        $institutions= $this->internship->getInstitutionsByPostIds($internship_list);
        $posts=$this->post->getListByIds($internship_list);
        $input=Input::all();

        $query = Internship::with('post');

        if(Input::get('institution'))
            $query->where('institution',$input['institution']);

        if(Input::get('brand'))
            $query->where('brand_id',$input['brand']);

        if(Input::get('status')!='')
            $query->where('status',$input['status']);

        if(Input::get('internship')!='')
            $query->where('post_id',$input['internship']);

        if(Input::get('startdate')!='' && Input::get('enddate')!='')
            $query->whereBetween('created_at',array(Input::get('startdate').' 00:00:01', Input::get('enddate').' 23:59:59'));

        $internships=$query->get();
//        dd($input);

        return View::make('admin.brands.internships.applications')->withInternships($internships)->withFilter($input)->withBrands($brands)->withPosts($posts)->withInstitutions($institutions)->withFilter2(1);
    }
    public function getApplicationsByPost($id)
    {
	$input=array('institution'=>'','brand'=>'','status'=>'','startdate'=>'','enddate'=>'','internship'=>$id);
        $brands = $this->brand->getBrandList();
        $institutions = $this->institution->getList();
        $internship_list=$this->post->getPostIdsByType('internship');
        $posts=$this->post->getListByIds($internship_list);
        $internships = Internship::with('post')->withTrashed()->where('post_id',$id)->orderBy('created_at','desc')->get();
        return View::make('admin.brands.internships.applications')->withInternships($internships)->withPosts($posts)->withFilter($input)->withBrands($brands)->withInstitutions($institutions);
    }
    public function getApplicationsExcelExport()
    {
        $internships 	= Internship::withTrashed()->orderBy('created_at','desc')->get();

        $internships 	= json_decode(json_encode(array_to_object($internships)), true);

        // Exporting to excel sheet
        Excel::create('ApplicationsList', function($excel) use($internships) {

            $excel->sheet('Applications', function($sheet) use($internships) {

                $sheet->fromArray($internships);

            });

        })->export('xls');

        return Redirect::back()->withFlashMessage('Internships exported as Excel successfully!');

     }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $internship = $this->post->find($id);
        $brands = Brand::orderBy('id')->lists('name', 'id');
        $cities= City::where('state_id','=',$internship->state)->lists('name', 'id');
        $categories= $this->category->getList();

        return View::make('admin.brands.internships.edit')->withInternship($internship)->withCities($cities)->withBrands($brands)->withCategories($categories);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //return Input::all();
        $internship = $this->post->find($id);

        $input = Input::only('brand_id', 'name','skills','description','category','state','city','offer_type','amount', 'positions','resume_preference', 'question1','question2','question3','question4','question5','application_date');

        try {
            $this->NewInternshipsForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $slug = Str::slug(Input::get('name'));

        $slug = $this->post->getSlug($slug);

        $input = array_add($input, 'slug', $slug);

        $input = array_add($input, 'status', Input::get('status'));

        if (Input::hasFile('image')) {
            $image = Input::file('image');

            $destinationPath = 'uploads/photos';

            $filename = time() . $image->getClientOriginalName();

            if ($image->move($destinationPath, $filename)) {
                $filename = $filename;
            }

            $input = array_add($input, 'image', $filename);
        }
        $input = array_add($input, 'start_date', date("Y-m-d", strtotime(Input::get('start_date'))));
        $input = array_add($input, 'end_date', date("Y-m-d", strtotime(Input::get('end_date'))));

        $internship->fill($input)->save();

        return Redirect::route('admin_internships')->withFlashMessage('Internships have been successfully updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    // method to do multi actions on selected internships
    public function postAdminInternshipsActions()
    {
        //echo "<pre>";print_r(Input::all());exit;
        $internships = Input::get('checkall');

        if ($internships) {
            if (Input::has('Activate')) {
                //$internships = Input::get('checkall');

                $this->post->activate($internships);

                return Redirect::back()->withFlashMessage('Selected internships Activated');

            }

            if (Input::has('Deactivate')) {
                //$internships = Input::get('checkall');

                $this->post->deactivate($internships);

                return Redirect::back()->withFlashMessage('Selected internships Deactivated');

            }

            if (Input::has('Trash')) {
                //$internships = Input::get('checkall');

                $this->post->trash($internships);

                return Redirect::back()->withFlashMessage('Selected internships Trashed');

            }

            if (Input::has('Untrash')) {
                //$internships = Input::get('checkall');

                $this->post->untrash($internships);

                return Redirect::back()->withFlashMessage('Selected internships Untrashed');

            }
        }
        return Redirect::back()->withErrorMessage('Select atleast some internships');
    }
}
