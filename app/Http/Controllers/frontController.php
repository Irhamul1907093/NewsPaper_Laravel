<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use DB;
use Session;
class frontController extends Controller
{
    //
    public function __construct(){
        $categories=DB::table('categories')->where('status','on')->get();
        $setting=DB::table('settings')->first();
         if($setting){
            $setting->social=explode(',',$setting->social);
           // print_r($data->social);
            //exit();
            foreach($setting->social as $social){
                $icon=explode('.',$social);
                $icon=$icon[1];
                $icons[]=$icon;
            }

        }
        else{
            $icons=[];
        }
        $lastnews=DB::table('posts')->where('status','publish')->orderby('pid','DESC')->first();
        $pages=DB::table('pages')->where('status','publish')->get();
        $leaderboard=DB::table('advertisements')->where('status','display')->where('location','Leaderboard')->orderby('aid','DESC')->first();
        $sidebarTop=DB::table('advertisements')->where('status','display')->where('location','Sidebar-top')->orderby('aid','DESC')->first();
        $sidebarBottom=DB::table('advertisements')->where('status','display')->where('location','Sidebar-bottom')->orderby('aid','DESC')->first();
        view()->share([
            'categories'=>$categories,
            'setting'=>$setting,
            'icons'=>$icons,
            'lastnews'=>$lastnews,
            'pages'=>$pages,
            'leaderboard'=>$leaderboard,
            'sidebarTop'=>$sidebarTop,
            'sidebarBottom'=>$sidebarBottom,
        ]);
    }

    public function index()
    {
        $featured=DB::table('posts')->where('category_id','LIKE','%8%')->orderby('pid','DESC')->get();
        // print_r($featured);
        //exit();
        $general=DB::table('posts')->where('category_id','LIKE','%9%')->orderby('pid','DESC')->get();
        $business=DB::table('posts')->where('category_id','LIKE','%4%')->orderby('pid','DESC')->get();
        $sports=DB::table('posts')->whereIn('category_id', [1])->orderby('pid','DESC')->get();
        $technology=DB::table('posts')->where('category_id','LIKE','%10%')->orderby('pid','DESC')->get();
        $health=DB::table('posts')->where('category_id','LIKE','%11%')->orderby('pid','DESC')->get();
        $travel=DB::table('posts')->where('category_id','LIKE','%12%')->orderby('pid','DESC')->get();
        $entertainment=DB::table('posts')->where('category_id','LIKE','%3%')->orderby('pid','DESC')->get();
        $politics=DB::table('posts')->whereIn('category_id', [2])->orderby('pid','DESC')->get();
        $style=DB::table('posts')->where('category_id','LIKE','%6%')->orderby('pid','DESC')->get();
        return view('frontend.index',['featured'=>$featured,'general'=>$general,'business'=>$business,'sports'=>$sports,'technology'=>$technology,'health'=>$health,'travel'=>$travel,'entertainment'=>$entertainment,'politics'=>$politics,'style'=>$style]);
    }
     public function category($slug)
    {
        $cat=DB::table('categories')->where('slug',$slug)->first(); //taking the category of that slug
        $posts=DB::table('posts')->where('category_id','LIKE','%'.$cat->cid.'%')->get(); //taking the posts of that cat
        //$posts = DB::table('posts')->where('category_id', $cat->cid)->get();

         $latest=DB::table('posts')->where('status','publish')->orderby('pid','DESC')->get();
        return view('frontend.category',['posts'=>$posts,'cat'=>$cat,'latest'=>$latest]);
    }
     public function article($slug)
    {
        $data=DB::table('posts')->where('slug',$slug)->first();
        //echo "$data->description";
        //exit();
        $views=$data->views;
        DB::table('posts')->where('slug',$slug)->update(['views'=>$views+1]);
        $category=explode(',',$data->category_id);
        $category=$category[0];
        //multiple catagories e selected thakle
        $related=DB::table('posts')->where('category_id','LIKE','%'.$category.'%')->get(); //exact er jnno equal
        $latest=DB::table('posts')->where('status','publish')->orderby('pid','DESC')->get();
        return view('frontend.article',['data'=>$data,'related'=>$related,'latest'=>$latest]);
    }

    public function searchContent(){
        $url='/article';
        $text=$_GET['text'];
        //print_r($text);
        $data=DB::table('posts')->where('title','LIKE','%'.$text.'%')->orwhere('description','LIKE','%'.$text.'%')->get();
        $output= '';
        echo '<ul class="search-result">';
        if(count($data)>0){
            foreach($data as $d){
            echo '<li><a href="'.$url.'/'.$d->slug.'">'.$d->title.'</a></li>';
        }
        }
        else{
             echo '<li><a>Sorry! No matches </a></li>';
        }
        
        echo '</ul>';
        return $output;
    }


    public function page($slug){
        $data=DB::table('pages')->where('slug',$slug)->first();
         $latest=DB::table('posts')->where('status','publish')->orderby('pid','DESC')->get();//this latest is at the top
        return view('frontend.page',['data'=>$data,'latest'=>$latest]);
    }
    public function contactUs()
    {
        // code...
         $latest=DB::table('posts')->where('status','publish')->orderby('pid','DESC')->get();
        return view('frontend.contact',['latest'=>$latest]);
    }

}
