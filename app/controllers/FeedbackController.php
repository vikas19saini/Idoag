<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\FeedbackRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;


class FeedbackController extends \BaseController {

    /**
     * @var $user
     *
     */
    protected $user;

    /**
     * @var $page
     *
     */
    protected $brand;
   
    protected $feedback;
	
	protected $institution;

    function __construct(UserRepositoryInterface $user, BrandRepositoryInterface $brand, InstitutionRepositoryInterface $institution, FeedbackRepositoryInterface $feedback)
    {
        $this->user		= $user;

        $this->brand 	= $brand;

        $this->feedback 	= $feedback;
		
		$this->institution	 = $institution;
    }

    // Landing Page View
    public function getInstFeedback($slug)
    {
        $institution_detail	= $this->institution->findBySlug($slug);

        $feedbacks= $this->feedback->getByInstitution($institution_detail->id);

        //dd($feedbacks);
        return View::make('institutions.feedback.list')->withInstitution($institution_detail)->withFeedbacks($feedbacks);
    }
	
	 public function getFeedback($slug)
    {
        $brand_detail	= $this->brand->findBySlug($slug);

        $feedbacks= $this->feedback->getByBrand($brand_detail->id);

        //dd($feedbacks);
        return View::make('brands.feedback.list')->withBrand($brand_detail)->withFeedbacks($feedbacks);
    }

    public function destroy($id)
    {
        dd($id);
        Feedback::destroy($id);
        return Redirect::back()->withFlashMessage('Feedback deleted successfully !');
    }
    public function deleteFeedback($id)
    {
        Feedback::destroy($id);
        $brand_slug=getBrandSlug(Sentry::getUser()->brand_id);
        return Redirect::route('get_feedback', array($brand_slug))->withFlashMessage('Feedback deleted successfully !');
    }
}