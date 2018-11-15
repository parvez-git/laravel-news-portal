<?php

namespace App\Http\Controllers;

use App\News;
use App\Category;
use App\Advertisement;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $topnewslist = News::latest()->whereHas('category')->where('status',1)->take(5)->get();

        $newscategory_one   = News::latest()->whereHas('category')->where('category_id',6)->where('status',1)->take(9)->get();
        $newscategory_two   = News::latest()->whereHas('category')->where('category_id',7)->where('status',1)->take(3)->get();
        $newscategory_three = News::latest()->whereHas('category')->where('category_id',3)->where('status',1)->take(10)->get();

        return view('frontend.index',compact(
                'topnewslist',
                'newscategory_one',
                'newscategory_two',
                'newscategory_three'
            )
        );
    }


    public function pageCategory($slug)
    {
        $category           = Category::where('slug',$slug)->first();
        $featurednewslist   = $category->newslist()->where('status',1)->where('featured',1)->take(5)->get();
        $newscategorylist   = $category->newslist()->where('status',1)->where('featured',0)->get();
        $advertisements     = Advertisement::where('type','category')->where('slug',$slug)->first();

        return view('frontend.pages.category',compact('category','featurednewslist','newscategorylist','advertisements'));
    }

    public function pageNews($slug)
    {
        $newssingle = News::with('category')->where('slug',$slug)->first();

        $newssessionkey = 'news-'.$newssingle->id;
        if(!session()->has($newssessionkey)){
            $newssingle->increment('view_count');
            session()->put($newssessionkey,1);
        }

        return view('frontend.pages.single',compact('newssingle'));
    }

    public function pageSearch()
    {
        $search = request()->input('search');

        $newssearch = News::with('category')->where('title','like','%'.$search.'%')->whereHas('category')->where('status',1)->get();

        return view('frontend.pages.search',compact('newssearch'));
    }

    public function pageArchive()
    {
        $newsarchives = Category::with('newslist')->whereHas('newslist')->get();

        return view('frontend.pages.index',compact('newsarchives'));
    }

}
