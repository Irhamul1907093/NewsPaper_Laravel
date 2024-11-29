<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;

use DB;
use Session;
//use Illuminate\Support\Facades\Input;
class crudController extends Controller
{
    //
    public  function insertData()
    {
        // code...
        $data=request()->except('_token');
        $tbl=decrypt($data['tbl']);
       // print_r($tbl);
        unset($data['tbl']);
        $data['created_at']=date('Y-m-d H:i:s');

        //dhuktese na block e
        if(request()->has('social')) 
        {
            //  print_r(request()->input('social'));
            $data['social']=implode(',', $data['social']);
            // print_r($data['social']);
            // exit();
        }

        if(request()->hasfile('image')) 
        {
         $data['image']=$this->uploadimage($tbl,$data['image']);
        }
     //converting to string
        if(request()->has('category_id')) 
        {
         $data['category_id']=implode(',',$data['category_id']);
        }

     DB::table($tbl)->insert($data);
     if($tbl=='messages'){
        session::flash('message','Thank you for reaching out to us. We value your input and look forward to assisting you.');
     }
     else{
        session::flash('message','Data inserted successfully');
     }
     
     return redirect()->back();
 }
      public  function updateData()
    {
        // code...
        $data=request()->except('_token');
        $tbl=decrypt($data['tbl']);
       // print_r($tbl);
        unset($data['tbl']);
        $data['updated_at']=date('Y-m-d H:i:s');

        if(request()->has('social')) 
        {
            $data['social']=implode(',', $data['social']);
        }

        if(request()->hasfile('image')) 
        {
         $data['image']=$this->uploadimage($tbl,$data['image']);
        }
        //converting to string
        if(request()->has('category_id')) 
        {
         $data['category_id']=implode(',',$data['category_id']);
        }


        DB::table($tbl)->where(key($data),reset($data))->update($data);
        session::flash('message','Data updated successfully');
        return redirect()->back();
    }
    public function uploadimage($location,$imagename){
        $name=$imagename->getClientOriginalName(); //giving original file name
        
        $imagename->move(public_path().'/'.$location,date('ymdgis').$name); //saving in a unique name with date
        //exit();
        return date('ymdgis').$name;


    }

}
