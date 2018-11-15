<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Category;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function index()
    {
        $advertisement  = Advertisement::all();
        $categories     = Category::orderBy('name','ASC')->where('status',1)->get();

        return view('backend.advertisement.index',compact('advertisement','categories'));
    }


    public function store(Request $request)
    {
        $type = $request->type;
        $slug = $request->slug;

        $request->validate([
            'type'  => 'required|string',
            'slug'  => 'required|unique:advertisements,id,'.$slug,
        ]);

        $advertisements = new Advertisement();

        if ($request->hasFile('header_top')) {
            $header_top = 'header-top-'.$type.'-'.$slug.'.'.$request->header_top->getClientOriginalExtension();
            $request->header_top->move(public_path('images/advertisements'), $header_top);
        }elseif(@$advertisements->where('type',$type)->where('slug',$slug)->first()->header_top){
            $header_top = $advertisements->where('type',$type)->where('slug',$slug)->first()->header_top;
        }else{
            $header_top = NULL;
        }

        if ($request->hasFile('body_middle')) {
            $body_middle = 'body-middle-'.$type.'-'.$slug.'.'.$request->body_middle->getClientOriginalExtension();
            $request->body_middle->move(public_path('images/advertisements'), $body_middle);
        }elseif(@$advertisements->where('type',$type)->where('slug',$slug)->first()->body_middle){
            $body_middle = $advertisements->where('type',$type)->where('slug',$slug)->first()->body_middle;
        }else{
            $body_middle = '';
        }

        if ($request->hasFile('sidebar_one')) {
            $sidebar_one = 'sidebar-one-'.$type.'-'.$slug.'.'.$request->sidebar_one->getClientOriginalExtension();
            $request->sidebar_one->move(public_path('images/advertisements'), $sidebar_one);
        }elseif(@$advertisements->where('type',$type)->where('slug',$slug)->first()->sidebar_one){
            $sidebar_one = $advertisements->where('type',$type)->where('slug',$slug)->first()->sidebar_one;
        }else{
            $sidebar_one = '';
        }

        $advertisements->updateOrCreate(
            [
                'type'   => $type,
                'slug'   => $slug
            ],
            [
                'type'          => $type,
                'slug'          => $slug,
                'header_top'    => $header_top,
                'body_middle'   => $body_middle,
                'sidebar_one'   => $sidebar_one
            ]
        );

        return back()->with(['message' => 'Advertisement updated successfully.']);
    }

}
