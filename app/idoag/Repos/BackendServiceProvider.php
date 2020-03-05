<?php namespace idoag\Repos;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

	public function register()
	{
		
		$this->app->bind(
			'idoag\Repos\UserRepositoryInterface',
			'idoag\Repos\DbUserRepository'
		);
		
		$this->app->bind(
			'idoag\Repos\SettingsRepositoryInterface',
			'idoag\Repos\DbSettingsRepository'
		);
		
		$this->app->bind(
			'idoag\Repos\SliderRepositoryInterface',
			'idoag\Repos\DbSliderRepository'
		);
		
		$this->app->bind(
			'idoag\Repos\BrandRepositoryInterface',
			'idoag\Repos\DbBrandRepository'
		);
		
		$this->app->bind(
			'idoag\Repos\CategoryRepositoryInterface',
			'idoag\Repos\DbCategoryRepository'
		);

        $this->app->bind(
            'idoag\Repos\Post\PostRepositoryInterface',
            'idoag\Repos\Post\DbPostRepository'
        );

        $this->app->bind(
            'idoag\Repos\Institution\InstitutionRepositoryInterface',
            'idoag\Repos\Institution\DbInstitutionRepository'
        );

        $this->app->bind(
            'idoag\Repos\Student\StudentRepositoryInterface',
            'idoag\Repos\Student\DbStudentRepository'
        );

        $this->app->bind(
            'idoag\Repos\Student\StudentDetailsRepositoryInterface',
            'idoag\Repos\Student\DbStudentDetailsRepository'
        );

        $this->app->bind(
            'idoag\Repos\PressRepositoryInterface',
            'idoag\Repos\DbPressRepository'
        );        

        $this->app->bind(
            'idoag\Repos\BrandsFollowsRepositoryInterface',
            'idoag\Repos\DbBrandsFollowsRepository'
        );  	

        $this->app->bind(
            'idoag\Repos\PostsLikesRepositoryInterface',
            'idoag\Repos\DbPostsLikesRepository'
        ); 
		
		   $this->app->bind(
            'idoag\Repos\PostsVisitsRepositoryInterface',
            'idoag\Repos\DbPostsVisitsRepository'
        ); 
		 
		 $this->app->bind(
            'idoag\Repos\InternshipCategoryRepositoryInterface',
            'idoag\Repos\DbInternshipCategoryRepository'
        ); 
		
		
		 $this->app->bind(
            'idoag\Repos\PageRepositoryInterface',
            'idoag\Repos\DbPageRepository'
        );
         
         $this->app->bind(
            'idoag\Repos\Student\StudentInternshipRepositoryInterface',
            'idoag\Repos\Student\DbStudentInternshipRepository'
        );   
		
		$this->app->bind(
            'idoag\Repos\OutletRepositoryInterface',
            'idoag\Repos\DbOutletRepository'
        );

        $this->app->bind(
            'idoag\Repos\FeedbackRepositoryInterface',
            'idoag\Repos\DbFeedbackRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\Student\CouponRepositoryInterface',
            'idoag\Repos\Student\DbCouponRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\Student\UserCouponRepositoryInterface',
            'idoag\Repos\Student\DbUserCouponRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\FaqRepositoryInterface',
            'idoag\Repos\DbFaqRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\TestimonialRepositoryInterface',
            'idoag\Repos\DbTestimonialRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\BrandRegistrationRepositoryInterface',
            'idoag\Repos\DbBrandRegistrationRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\InstitutionRegistrationRepositoryInterface',
            'idoag\Repos\DbInstitutionRegistrationRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\InstitutionRepositoryInterface',
            'idoag\Repos\DbInstitutionRepository'
        );
		
		 $this->app->bind(
            'idoag\Repos\InstitutionsFollowsRepositoryInterface',
            'idoag\Repos\DbInstitutionsFollowsRepository'
        );

        $this->app->bind(
            'idoag\Repos\EnquiryRepositoryInterface',
            'idoag\Repos\DbEnquiryRepository'
        );

        $this->app->bind(
            'idoag\Repos\FaqCategoryRepositoryInterface',
            'idoag\Repos\DbFaqCategoryRepository'
        );
		
		  $this->app->bind(
            'idoag\Repos\InstTestimonialRepositoryInterface',
            'idoag\Repos\DbInstTestimonialRepository'
        );
		
		  $this->app->bind(
            'idoag\Repos\StudentRegistrationRepositoryInterface',
            'idoag\Repos\DbStudentRegistrationRepository'
        );

        $this->app->bind(
            'idoag\Repos\AdRepositoryInterface',
            'idoag\Repos\DbAdRepository'
        );

        $this->app->bind(
            'idoag\Repos\ProblemRepositoryInterface',
            'idoag\Repos\DbProblemRepository'
        );

        $this->app->bind(
            'idoag\Repos\PincodeRepositoryInterface',
            'idoag\Repos\DbPincodeRepository'
        );

        $this->app->bind(
            'idoag\Repos\CardCouponRepositoryInterface',
            'idoag\Repos\DbCardCouponRepository'
        );

        $this->app->bind(
            'idoag\Repos\Student\StudentInternshipDetailsRepositoryInterface',
            'idoag\Repos\Student\DbStudentInternshipDetailsRepository'
        );

        $this->app->bind(
            'idoag\Repos\ActivityRepositoryInterface',
            'idoag\Repos\DbActivityRepository'
        );

		
    }
} 