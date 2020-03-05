<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\SettingsRepositoryInterface;
use idoag\Repos\SliderRepositoryInterface;
use idoag\Repos\PageRepositoryInterface;
use idoag\Repos\PressRepositoryInterface;
use idoag\Repos\FaqRepositoryInterface;
use idoag\Repos\FaqCategoryRepositoryInterface;
use idoag\Forms\EnquiryForm;
use idoag\Repos\EnquiryRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\InstitutionRepositoryInterface;

class PagesController extends \BaseController {

    /**
     * @var $user 
     *
     */
    protected $user;
    protected $brand;
    protected $institution;

    /**
     * @var $page
     *
     */
    protected $page;

    /**
     * @var $setting 
     *
     */
    protected $setting;

    /**
     * @var $slider 
     *
     */
    protected $slider;

    /**
     * @var $press 
     *
     */
    protected $press;
    protected $faq;
    protected $faq_category;
    protected $enquiry;
    protected $enquiryForm;

    /**
     * PagesController Constructor function 
     * 
     */
    function __construct(UserRepositoryInterface $user, PageRepositoryInterface $page, InstitutionRepositoryInterface $institution, BrandRepositoryInterface $brand, FaqCategoryRepositoryInterface $faq_category, EnquiryRepositoryInterface $enquiry, PressRepositoryInterface $press, SettingsRepositoryInterface $setting, SliderRepositoryInterface $slider, FaqRepositoryInterface $faq, EnquiryForm $enquiryForm) {
        $this->user = $user;

        $this->setting = $setting;

        $this->slider = $slider;

        $this->faq_category = $faq_category;

        $this->press = $press;

        $this->page = $page;

        $this->brand = $brand;

        $this->institution = $institution;

        $this->faq = $faq;

        $this->enquiry = $enquiry;

        $this->enquiryForm = $enquiryForm;

        $result = $this->setting->getAll();

        //echo "<pre>";print_r($result[0]->logo);exit;

        if (isset($result) && $result) {

            $settings = $result;

            View::share('settings', $settings);
        }
    }

    // Landing Page View
    public function index() {
        if (Sentry::check()) {

            $loggedin_user = Sentry::getUser();

            $user_group = $loggedin_user->getGroups()->first()->name;

            if ($user_group == 'Students') {
                return Redirect::route('student_dashboard');
            }
            if ($user_group == 'Brands') {
                return Redirect::route('brand_profile', array(getBrandSlug($loggedin_user->brand_id)));
            }
            if ($user_group == 'Admin') {
                return Redirect::route('admin');
            }
            if ($user_group == 'Institution') {
                return Redirect::route('institution_profile', array(getInstitutionSlug($loggedin_user->institution_id)));
            }
        }

        $main_banner_sliders = $this->slider->getByCategory('HomePageMainBanner');

        $second_banner_sliders = $this->slider->getByCategory('HomePageSecondBanner');

        $third_banner_sliders = $this->slider->getByCategory('HomePageThirdBanner');

        //$third_banner_sliders_images 	= $this->slider->getWhere('page_name', 'HomePageThirdBannerImages');

        $fourth_banner_sliders = $this->slider->getByCategory('HomePageFourthBanner');

        $fifth_banner_sliders = $this->slider->getByCategory('HomePageFifthBanner');

        $press = $this->press->getActive();

        $page = $this->page->find(6);

        return View::make('pages.index')
                        ->withMainBannerSliders($main_banner_sliders)
                        ->withSecondBannerSliders($second_banner_sliders)
                        ->withThirdBannerSliders($third_banner_sliders)
                        //->withThirdBannerSlidersImages($third_banner_sliders_images)
                        ->withFourthBannerSliders($fourth_banner_sliders)
                        ->withFifthBannerSliders($fifth_banner_sliders)
                        ->withPress($press)->withPage($page);
    }

    // FAQ Page View
    public function getFaq() {
        $faq_categories = FaqCategory::with('Faqs')->get();

        //$categories = $this->faq_category->getAll();
        //echo '<pre>';print_r($faq_categories);exit();

        return View::make('pages.faq')->withFaqCategories($faq_categories); //->withCategories($categories);
    }

    // TOS Page View
    public function getTermsOfService() {
        $page = $this->page->find(2);
        return View::make('pages.tos')->withPage($page);
    }

    // Blog Page View
    public function getBlog() {
        $page = $this->page->find(2);
        return View::make('pages.blog')->withPage($page);
    }

    // Sitemap Page View
    public function getSitemap() {
        $brands = $this->brand->getAll();
        $institutions = $this->institution->getAll();

        return View::make('pages.sitemap')->withInstitutions($institutions)->withBrands($brands);
    }

    // Contact us Page View
    public function getContactus() {
        return View::make('pages.contactus');
    }

    // About Page View
    public function getAbout() {
        $page = $this->page->find(1);
        return View::make('pages.about')->withPage($page);
    }

    // Services Page View
    public function getServices() {
        $page = $this->page->find(4);
        return View::make('pages.services')->withPage($page);
    }

    // Offline Activation Page View
    public function getOfflineActivation() {
        $page = $this->page->find(7);
        return View::make('pages.offline_activation')->withPage($page);
    }

    // Privacy Policy Page View
    public function getPrivacyPolicy() {
        $page = $this->page->find(5);
        return View::make('pages.privacy_policy')->withPage($page);
    }

    // Support Page View
    public function getSupport() {
        $page = $this->page->find(3);
        return View::make('pages.support')->withPage($page);
    }

    // Internships Page View
    public function getInternships() {
        return View::make('pages.internships');
    }

    // Offers Page View
    public function getOffers() {
        return View::make('pages.offers');
    }

    // OfferDetails Page View
    public function getOfferDetails() {
        return View::make('pages.offer-details');
    }

    public function postEnquiry() {
        $input = Input::all();

        try {
            $this->enquiryForm->validate($input);
        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $this->enquiry->create($input);

        return Redirect::route('contactus')->withFlashMessage('We have received your query and will get back to you as soon as possible.');
    }

    public function postHelpRequest() {
        $input = Input::all();
        $data['name'] = Input::get('name');
        $data['email'] = Input::get('email');
        $data['phone'] = Input::get('phone');
        $data['msg'] = Input::get('message');
        Mailgun::send('emails.needhelp', $data, function($message) use($data) {
            $message->subject('User need help');
            $message->from($data['email'], $data['name']);
            $message->replyTo($data['email']);
            $message->to('info@gmail.com', 'Admin');
        });

        return Redirect::back()->withFlashMessage('We have received your query and will get back to you as soon as possible.');
    }

    public function cardActivationIssue() {
        $data = array();

        $admin = 'info@idoag.com';

        $data['name'] = Input::get('name');
        $data['email'] = Input::get('email');
        $data['phone'] = Input::get('phone');
        $data['card_number'] = Input::get('card_number');
        $data['comments'] = Input::get('message');

        $user = User::where('card_number', $data['card_number'])->first();

        $student_data = Student::where('card_number', $data['card_number'])->first();

        $dob = Student::where('card_number', $data['card_number'])->pluck('dob');

        if ($dob) {
            $data['dob'] = $dob;
        } else {
            $data['dob'] = "";
        }

        Mailgun::send('emails.card_activation_issue', $data, function($message) use($data) {
            $message->subject('Card Activation Query');

            $message->to($data['email'], $data['name']);
        });

        //  Different Subject messages for admin...

        if ($user) {
            if ($user->activated == 0) {

                Mailgun::send('emails.admin_card_activation_issue', $data, function($message) use($data, $admin) {
                    $message->subject('Card Activation Query : Card Activated & Email not confirmed');
                    $message->replyTo($data['email']);
                    $message->to($admin, 'Admin');
                });
            } else {

                Mailgun::send('emails.admin_card_activation_issue', $data, function($message) use($data, $admin) {
                    $message->subject('Card Activation Query : Card is Active');
                    $message->replyTo($data['email']);
                    $message->to($admin, 'Admin');
                });
            }
        } elseif ($student_data) {

            Mailgun::send('emails.admin_card_activation_issue', $data, function($message) use($data, $admin) {
                $message->subject('Card Activation Query : Card is Inactive & DOB Sent');
                $message->replyTo($data['email']);
                $message->to($admin, 'Admin');
            });
        }

        return Response::json(array('error' => 'false', 'message' => ' We regret the inconvenience. We will get back to you as soon as we can.'));
    }

    public function cardNumberExists() {
        $card_number = Input::get('card_number');

        $user = User::where('card_number', $card_number)->first();

        $student_data = Student::where('card_number', $card_number)->pluck('dob');

        if ($user) {
            if ($user->activated == 0)
                return json_encode(array('valid' => true, 'new_message' => 'You have activated your card but not verified the email-id. Click on link that was sent to you on this email :' . $user['email']));
            else
                return json_encode(array('valid' => true, 'new_message' => 'This Card Number is activated. Please login with your Email :' . $user['email']));
        }
        elseif ($student_data) {
            return json_encode(array('valid' => true, 'new_message' => ''));
        } else {
            return json_encode(array('valid' => false, 'new_message' => 'please enter a valid card number'));
        }
    }

    public function validateCardAndUserType() {
        $card_number = Input::get('card_number');

        $user = User::where('card_number', $card_number)->first();

        $student_data = Student::join('institutions', 'institutions.id', '=', 'student_data.college_id')->where('student_data.card_number', $card_number)->get();

        if ($user) {
            if ($user->activated == 0)
                return json_encode(array('valid' => true, 'new_message' => 'You have activated your card but not verified the email-id. Click on link that was sent to you on this email :' . $user['email']));
            else
                return json_encode(array('valid' => true, 'new_message' => 'This Card Number is activated. Please login with your Email :' . $user['email']));
        }
        elseif (count($student_data) > 0) {
            if ($student_data[0]->type === 'company') {
                $institutions = Institution::where('type', 'company')->get();
                return json_encode(array('valid' => true, 'new_message' => '', 'type' => $student_data[0]->type, 'companies' => $institutions));
            } else {
                return json_encode(array('valid' => true, 'new_message' => '', 'type' => $student_data[0]->type));
            }
        } else {
            return json_encode(array('valid' => false, 'new_message' => 'please enter a valid card number'));
        }
    }

    public function campagin() {
        return View::make('pages.campagin');
    }
    
    public function post_campagin() {
        $input = Input::except('_token');
        $campagin = DB::table('campaign');
        $campagin->insert($input);
        return Redirect::route('campagin')->withFlashMessage('Your details has been saved.');
    }
}
