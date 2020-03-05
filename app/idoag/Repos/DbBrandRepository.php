<?php namespace idoag\Repos;

use \Brand;
use \Post;
use \Internship;
use \User;
use \DB;
use \Sentry;
use \Mailgun;
use \Log;

class DbBrandRepository implements BrandRepositoryInterface
{

	public function getAll()
	{
		return Brand::where('status','1')->get();
	}
    public function getWithLimit($limit)
    {

        return Brand::where('status','1')->take($limit)->get();
    }
    public function getBrandsByIds($ids)
    {
        return Brand::where('status','1')->whereIn('id', $ids)->get();
    }
	
	public function getList()
	{
		return Brand::where('status','1')->orderBy('name')->lists('name', 'slug');
	}
    public function getBrandList()
    {
        return Brand::where('status','1')->orderBy('name')->lists('name', 'id');
    }


	public function find($id)
	{
		return Brand::withTrashed()->findOrFail($id);
	}

    public function create($fields)
    {
    	return Brand::create($fields);
    }

	public function findByName($value)
	{
		return Brand::where('name', $value)->first();
	}
	
	public function findBySlug($value)
	{
		return Brand::where('slug', $value)->first();
	}

	public function getWhere($column, $value, $trash = null)
	{
		if($trash != null)
		{
			
			return Brand::where($column, $value)->whereNotNull('deleted_at')->get();
			
		} else {
			
			return Brand::where($column, $value)->whereNull('deleted_at')->get();
		}
		
	}
	
	public function delete($id)
	{
		return Brand::destroy($id);
	}

	public function activate($ids)
	{
		return Brand::whereIn('id', $ids)->update(array('status' => 1));
	}
	
	public function deactivate($ids)
	{
		return Brand::whereIn('id', $ids)->update(array('status' => 0));
	}
	
	public function trash($ids)
	{
		return Brand::whereIn('id', $ids)->update(array('deleted_at' => date('y-m-d H:i:s'), 'status' => 0));
	}
	
	public function untrash($ids)
	{
		return Brand::withTrashed()->whereIn('id', $ids)->update(array('deleted_at' => null, 'status' => 1));
	}
	
	public function getSlug($slug)
	{
		$slugCount 	= count( Brand::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	 
		if($slugCount == 1)
		{
			$brand = Brand::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->first();
			
			return $slug;
			
		} else {
			
			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}
	}
	
	public function findByCategory($slug)
	{
		return Brand::where('status','1')->where('category', 'LIKE', '%'.$slug.'%')->get();
	}
    public function getListByCategory($slug)
    {
        return Brand::where('status','1')->where('category', 'LIKE', '%'.$slug.'%')->lists('id');
    }
    public function profilePicture($id,$image)
    {
        return DB::table('brands')->where('id', $id)->update(array('image' => $image));
	}

    public function sendInternshipListToBrand()
    {
        //first fetch all the internships which will ends today
        $current_date=date('Y-m-d');
        $internships_by_brand = Internship::where('created_at','>=',$current_date)->select('brand_id', DB::raw('count(*) as total'))->groupBy('brand_id')->get();
//        Log::info('Internship Brand sent mail  '. $internships_by_brand);

        foreach ($internships_by_brand as $internship) {

            //get the internships list by brand
            $internships = Internship::where('brand_id', $internship->brand_id)->where('created_at','>=',$current_date)->get();
            $brand_details = self::find($internship->brand_id);
            $user = User::where('brand_id', $brand_details->id)->first();
            Log::info('Internship Brand mail sent to Brand - '. $brand_details->name);

            $data = array();
            $data['internships'] = $internships;
            $data['brand'] = $brand_details;
            $data['user'] = $user;

            // echo('<pre>');print_r($data);exit;
           Mailgun::send('emails.brand_internships', $data, function ($message) use ($user) {
                $message->to($user->email)->subject('Summary of Internship Applications Received – '.date("jS F Y", strtotime(date('d-m-y'))));
            });

//            Mailgun::send('emails.brand_internships', $data, function ($message) use ($user,$current_date) {
 //               $message->to('sekhar@igenero.com')->subject('Summary of Internship Applications Received – '.date("jS F Y", strtotime($current_date)));
 //           });

        }
    }

    public function sendInternshipListToAdmin()
    {
        $current_date=date('Y-m-d');

            //get the internships list by brand
            $internships = Internship::where('created_at','>=',$current_date)->get();

        if($internships)
        {
            $data = array();
            $data['internships'] = $internships;
            $admin="info@idoag.com";

            // echo('<pre>');print_r($data);exit;
            Mailgun::send('emails.admin_internships', $data, function ($message) use ($admin) {
                $message->to($admin)->subject('Summary of Internship Applications Received – '.date("jS F Y", strtotime(date('d-m-y'))));
            });
        }

    }
}