<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use DB;
use Session;

class adminController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }
      public function index()
    {
        return view('backend.master');
    }
     /* public function check()
    {
        return view('backend.categories.a');
         
    }*/
     public function category()
    {
        $data=DB::table('categories')->get();
        return view('backend.categories.category',['data'=>$data]);
    }
    public function editCategory($id){
        $singledata=DB::table('categories')->where('cid',$id)->first(); 
    
        if($singledata==NULL){
            return redirect('viewcategory');
        }

        $data=DB::table('categories')->get();
        return view('backend.categories.editcategory',['data'=>$data,'singledata'=>$singledata]);
    }
    public function multipleDelete(){
        $data=request()->except('_token');
       // print_r($data);
        if($data['bulk-action']==0){
            session::flash('message','Please select the operation you want to perform');
            return redirect()->back();
        }
        //decrypting name
        $tbl=decrypt($data['tbl']);
        $tblid=decrypt($data['tblid']);
        if(empty($data['select-data'])){
            session::flash('message','Please select the data you want to delete');
            return redirect()->back();
        }
        $ids=$data['select-data'];
       // print_r($ids);
        foreach ($ids as $id ) {
            // code...
            DB::table($tbl)->where($tblid,$id)->delete();
        }
        session::flash('message','Data deleted successfully');
            return redirect()->back();
    }
    public function settings(){
        $data=DB::table('settings')->first(); //get die hoise ,first die prothom e hoi nai
        
       // echo $data->about;
       // echo $data->social;
           if($data){
            $data->social=explode(',',$data->social);
           // print_r($data->social);
            //exit();     
        }
        //$data = json_decode(json_encode($data), true);

        return view('backend.settings',['data'=>$data]);
        //return view('backend.settings')->with('data', $data);
    }

    public function addPost(){
        $categories=DB::table('categories')->get();
        return view('backend.posts.add-post',['categories'=>$categories]);
    }

    public function allPosts(){
        $posts=DB::table('posts')->orderby('pid','DESC')->paginate(15);
        foreach($posts as $post){
            $categories=explode(',',$post->category_id);
            //ek e title e multiple cat
            foreach($categories as $cat){
                $postcat=DB::table('categories')->where('cid',$cat)->value('title');
                $postcategories[]=$postcat;
                //print_r($postcat);
                 $postcat=implode(',',$postcategories);
            }        
            $post->category_id=$postcat;
            $postcategories=[];
        }
      //  exit();
        $published=DB::table('posts')->where('status','publish')->count();
        $allposts=DB::table('posts')->count();
        return view('backend.posts.all-posts',['posts'=>$posts,'published'=>$published,'allposts'=>$allposts]);
    }
    public function editPost($id){
        $data=DB::table('posts')->where('pid',$id)->first();
        $postcat=explode(',',$data->category_id);
        $categories=DB::table('categories')->get();
        return view('backend.posts.edit',['data'=>$data,'categories'=>$categories,'postcat'=>$postcat]);
        //return view('backend.posts.edit');
    }

    //pages
    public function addPage(){
        return view('backend.pages.add-page');
    }

    public function allPages(){
        $posts=DB::table('pages')->get();
        $published=DB::table('pages')->where('status','publish')->count();
        $allposts=DB::table('pages')->count();
        return view('backend.pages.all-pages',['posts'=>$posts,'published'=>$published,'allposts'=>$allposts]);
    }
    public function editPage($id){
        $data=DB::table('pages')->where('pageid',$id)->first();
        return view('backend.pages.edit',['data'=>$data]);
    }
    public function messages(){
        $data=DB::table('messages')->orderby('mid','DESC')->paginate(15);
        return view('backend.messages',['data'=>$data]);
    }
    public function addAdv(){
        return view('backend.advertisement.add-advertisement');
    }
    public function allAdv(){
        $data=DB::table('advertisements')->orderby('aid','DESC')->get();
        return view('backend.advertisement.all-advertisement',['data'=>$data]);
    }
    public function editAdv($id){
        $data=DB::table('advertisements')->where('aid',$id)->first();
        return view('backend.advertisement.edit-advertisement',['data'=>$data]);
    }
}
