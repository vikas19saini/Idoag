<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\Post\PostRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;
use idoag\Repos\Student\StudentRepositoryInterface;
use idoag\Repos\Student\StudentDetailsRepositoryInterface;

class SearchController extends \BaseController {
	
	/**
	 * @var $user 
	 *
	 */
	protected $user;
	
	/**
	 * @var $brand 
	 *
	 */
	protected $brand;

    protected $institution;

	/**
	 * @var $student 
	 *
	 */
	protected $student;
	
	/**
	 * @var $student 
	 *
	 */
	protected $post;

	/**
	 * SessionsController Constructor function 
	 * 
	 */
	function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand, OutletRepositoryInterface $outlet,InstitutionRepositoryInterface $institution, StudentRepositoryInterface $student, StudentDetailsRepositoryInterface $student_details, PostRepositoryInterface $post)
	{
		$this->user 				= $user;
		
		$this->post 				= $post;

		$this->brand 				= $brand;

        $this->institution          =  $institution;

		$this->student 				= $student;

		$this->outlet 				= $outlet;

		$this->student_details 		= $student_details;
				
	}

	public function searchOffer()
	{
		$input = Input::get('keywords');

		$type = "offer"; 

		$posts = $this->post->getPostByType($type);

		//echo"<pre>";print_r($posts);exit();

		$offers = new \Illuminate\Database\Eloquent\Collection;

		foreach ($posts as $post) {

            if(str_contains(Str::lower($post->name), Str::lower($input)) || str_contains(Str::lower($post->short_description), Str::lower($input)) || str_contains(Str::lower(getbrandname($post->brand_id)), Str::lower($input)))
            {

                $offers->add($post);

			}
		}

            $offers=PostsExpiredToLast($offers);
            
            return View::make('students.partials.offersearch')->withOffers($offers);//$offers;
	}

    public function searchBrand()
    {
        $input = Input::get('keywords');


        $brands_list = $this->brand->getAll(); //echo"<pre>";print_r($brands_list);exit();


        $brands = new \Illuminate\Database\Eloquent\Collection;

        foreach ($brands_list as $brand) {

            if(str_contains(Str::lower($brand->name), Str::lower($input) ) || str_contains(Str::lower($brand->category), Str::lower($input)) )	{

                $brands->add($brand);

            }
        }

        return View::make('students.partials.brandsearch')->withBrands($brands);//$brands_list;
    }

    public function searchInstitution()
    {
        $input = Input::get('keywords');


        $institutions_list = $this->institution->getAll();


        $institutions= new \Illuminate\Database\Eloquent\Collection;

        foreach ($institutions_list as $institution) {



            if(str_contains(Str::lower($institution->name), Str::lower($input) ))	{

                $institutions->add($institution);
            }
        }

        return View::make('students.partials.institutionsearch')->withInstitutions($institutions);
    }
    public function searchInternship()
    {
        $input = Input::get('keywords');

        $type = "internship";

        $posts = $this->post->getAllPostByType($type);

       // echo"<pre>";print_r($posts);exit();

        $internships = new \Illuminate\Database\Eloquent\Collection;

        foreach ($posts as $post) {

            if(str_contains(Str::lower($post->name), Str::lower($input) ) || str_contains(Str::lower($post->short_description), Str::lower($input) ) ||str_contains(Str::lower(getbrandname($post->brand_id)), Str::lower($input)))	{
                $internships->add($post);
             //   echo "added ".$post->name;
            }
        }
        $internships=PostsExpiredToLast($internships);

        return View::make('students.partials.internshipsearch')->withInternships($internships);//$internships;
    }

    public function searchFaq()
    {
    	$input = Input::get('keywords');

		$faqs_data = Faq::all();

		$faqs = new \Illuminate\Database\Eloquent\Collection;

		foreach ($faqs_data as $faq) {

            if(str_contains(Str::lower($faq), Str::lower($input) ))	{

                $faqs->add($faq);
			}
		}
        //print_r($faqs);
		return View::make('partials.search_faq')->withFaqs($faqs);
    }

    public function searchOutlet()
    {
        $input = Input::get('keywords');

        $brand_id = Input::get('brand_id');

        $brand = Brand::find($brand_id);

        $outlets_list = $this->outlet->getByBrand($brand_id); //echo"<pre>";print_r($outlets_list);exit();


        $outlets = new \Illuminate\Database\Eloquent\Collection;

        foreach ($outlets_list as $outlet) {

            if(str_contains(Str::lower($outlet->name), Str::lower($input) ) || str_contains(Str::lower($outlet->address), Str::lower($input) ) 
            	|| str_contains(Str::lower($outlet->city), Str::lower($input) ) || str_contains(Str::lower($outlet->locality), Str::lower($input) )
            	|| str_contains(Str::lower($outlet->state), Str::lower($input) ) )	{

                $outlets->add($outlet);

            }
        }

        return View::make('brands.partial.outletsearch')->withOutlets($outlets)->withBrand($brand);//$outlets_list;    
    }
}