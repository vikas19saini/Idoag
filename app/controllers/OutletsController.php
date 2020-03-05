<?php

use idoag\Repos\UserRepositoryInterface;
use idoag\Repos\BrandRepositoryInterface;
use idoag\Repos\OutletRepositoryInterface;
use idoag\Forms\NewOutletForm;

class OutletsController extends \BaseController {

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

    /**
     * @var $user_id
     */
    protected $outlet;
    /**
     * @var $post
     *
     */
    protected $post;


    private $user_id;

    /**
     * PagesController Constructor function
     *
     */
    function __construct(UserRepositoryInterface $user, OutletRepositoryInterface $outlet, BrandRepositoryInterface $brand, NewOutletForm $NewOutletForm)
    {

        $this->user		        = $user;

        $this->outlet 	        = $outlet;

        $this->brand 	        = $brand;
        
        $this->NewOutletForm	= $NewOutletForm;

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug, $id)
    {
        $brand_detail	= $this->brand->findBySlug($slug);

        $outlet_detail = $this->outlet->find($id);

        $cities= City::where('state_id','=',$outlet_detail->state)->lists('name', 'id');

        return View::make('brands.outlets.edit')->withBrand($brand_detail)->withOutlet($outlet_detail)->withCities($cities);
    }


    public function getOutlets($slug)
    {

        $brand_detail	= $this->brand->findBySlug($slug);

        $outlets= $this->outlet->getByBrand($brand_detail->id);

        return View::make('brands.outlets.list')->withBrand($brand_detail)->withOutlets($outlets);
    }

    public function createOutlet($slug){

        $brand_detail	= $this->brand->findBySlug($slug); 
          
        return View::make('brands.outlets.create')->withBrand($brand_detail);

    }

    public function store()
    {
        $user  = Sentry::getUser();

        $input = Input::all();

        try
        {
            $this->NewOutletForm->validate($input);

        } catch (\Laracasts\Validation\FormValidationException $e) {

            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $input['city']  = Input::get('city') ;

        $input['state'] =  Input::get('state');

        $input = array_add($input, 'user_id', $user->id);

        $brand_slug=getBrandSlug($user->brand_id);

        $this->outlet->create($input);

        return Redirect::route('get_outlets', array($brand_slug))->withFlashMessage('Outlet added successfully!');

     }

    public function update($id)
    {
            $rules = [
                'name'			=> 'required',
                'city' 	=> 'required',
                'state' 	=> 'required',
            ];

            $outlet= $this->outlet->find($id);
            $input = Input::all();
            $validator = Validator::make($input,$rules);

            if($validator->fails())
            {

                return Redirect::back()->withInput()->withErrors($validator);
            }
            else {
                 $outlet->fill($input)->save();

                $brand_detail	= $this->brand->find($outlet->brand_id);

                return Redirect::route('get_outlets', [$brand_detail->slug]) ->withFlashMessage('Outlet updated successfully!');
            }
        }

    public function getOutletExport()
    {
        // Exporting to excel sheet                          
        Excel::create('outlets', function($excel){
        
            $excel->sheet('outlets_details', function($sheet){
        
                $sheet->fromArray(
                    array('name','address','state','city','locality','contact_details')
                );

                $sheet->setStyle(array(
                        'font'      =>  array(
                        'name'      =>  'Calibri',
                        'size'      =>  15,
                        'bold'      =>  true
                    )
                ));  
            });                             
        
        })->export('xls');
        
        return Redirect::back()->withFlashMessage('Sample Excel exported successfully!');
     
    }

    public function postOutletsDelete()
    {
        $user       = Sentry::getUser();

        $outlet_delete = Outlet::where('brand_id',$user->brand_id)->delete();
        
        if($outlet_delete)
            return Redirect::back()->withFlashMessage('Outlets deleted successfully !');

        else
            return Redirect::back()->withErrorMessage('There are no Outlets to delete !');

    }
    public function postOutletsExcelImport()
    {
        $user       = Sentry::getUser(); //echo"<pre>";print_r($user->id);exit();

        $file       = Input::file('file');
        
        $filename   = Str::lower(
                        pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        .'.'
                        .$file->getClientOriginalExtension()
                    );
                        
        $file->move('imports', $filename);
        
        $results = Excel::load('imports/'.$filename, function($reader) {
                        
        })->toArray();
        
        $total=0; $exists_count = 0;
        
        foreach($results as $result)
        {
            $input = array('name'=> $result['name'],'address'=> $result['address'],'state'=> $result['state'],'city'=> $result['city'],'locality'=> $result['locality'],'contact_info'=> $result['contact_details'], 'brand_id'=> $user->brand_id,'user_id'=> $user->id);

            if($result['name'] == '' || $result['address'] == '' || $result['state'] == '' || $result['city'] == '' || $result['locality'] == '' || $result['contact_details'] == '')
            {
                return Redirect::back()->withErrorMessage($total. 'records are inserted. Few Important Fields were missing in the Excel. Please fix and try again');
            }

            $exists = Outlet::where('brand_id', '=', $user->brand_id)
                            ->where('name', '=', $result['name'])
                            ->where('address', '=', $result['address'])
                            ->where('state', '=', $result['state'])
                            ->where('city', '=', $result['city'])
                            ->where('locality', '=', $result['locality'])
                            ->where('contact_info', '=', $result['contact_details'])
                            ->first();

            // print_r($exists);exit();

            if(empty($exists))
            {
                $this->outlet->create($input);

                $total=$total+1;
            }
            else
            {
                $exists_count = $exists_count+1;
            }        
        }

        if($total != 0 and $exists_count != 0)
        {
            return Redirect::back()->withFlashMessage($total.' outlets were added successfully')->withErrorMessage($exists_count.' duplicates were found');
        }
        else if($total != 0 and $exists_count == 0)
        {
            return Redirect::back()->withFlashMessage($total.' outlets were added successfully.');
        }
        else if($total == 0 and $exists_count != 0)
        {
            return Redirect::back()->withErrorMessage($exists_count.' duplicates were found.');
        }        
        else
        {
            return Redirect::back()->withErrorMessage('Error in outlets excel importing! Please try again');
        }
    }

    public function destroy($id)
    {
        Outlet::destroy($id);
        
        return Redirect::back()->withFlashMessage('Outlet deleted successfully !');
    }

}
