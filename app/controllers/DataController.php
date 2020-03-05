<?php

class DataController extends \BaseController {

	 public function getCityByStateId()
     {
         $id = Input::get('id');

         $city = City::where('state_id','=',$id)->get();

         $options = '<option value="">Select City</option>';

         foreach($city as $data)
         {

             $options .= '<option value="'.$data->id.'">'.$data->name.'</option>';

         }

         return $options;
     }

}
