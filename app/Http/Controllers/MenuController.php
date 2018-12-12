<?php

namespace App\Http\Controllers;

use App\Menu;
use App\News;
use App\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::orderBy('menuorder','asc')->get();

        return view('backend.menu.index', compact('menus'));
    }
    
    
    public function create()
    {
        $categories = Category::with('newslist')->orderBy('name','asc')->get();
        $menus = Menu::where('parent_id',0)->orderBy('name','asc')->get();

        return view('backend.menu.create', compact('categories','menus'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'type'      => 'required',
            'name'      => 'required',
            'menu_url'  => 'required',
            'menuorder' => 'required',
            'parent_id' => 'required'
        ]);

        Menu::create([
            'type'      => $request->type, 
            'name'      => $request->name, 
            'menu_url'  => $request->menu_url, 
            'menuorder' => $request->menuorder, 
            'parent_id' => $request->parent_id
        ]);

        $notification = array(
            'message'    => 'Menu created successfully !', 
            'alert-type' => 'success'
        );

        return redirect()->route('admin.menus.index')->with($notification);
    }


    public function show(Menu $menu)
    {
        //
    }


    public function edit(Menu $menu)
    {
        $menus = Menu::where('parent_id',0)->orderBy('name','asc')->get();
        
        return view('backend.menu.edit', compact('menu','menus'));
    }


    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'      => 'required',
            'menu_url'  => 'required',
            'menuorder' => 'required',
            'parent_id' => 'required'
        ]);

        $menu->update([
            'name'      => $request->name, 
            'menu_url'  => $request->menu_url, 
            'menuorder' => $request->menuorder, 
            'parent_id' => $request->parent_id
        ]);

        $notification = array(
            'message'    => 'Menu updated successfully !'
        );

        return redirect()->route('admin.menus.index')->with($notification);
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with(['message' => 'Menu deleted successfully.']);
    }

    public function getMenuItems(){

        $menutype = request()->input('menutype');

        switch ($menutype) {
            case 'category':
                $menuitems = Category::select('id','name')->where('status',1)->orderBy('name','asc')->get();
                break;

            case 'news':
                $menuitems = News::select('id','title as name')->where('status',1)->orderBy('title','asc')->get();
                break;
            
            default:
                $menuitems = [];
                break;
        }

        return response()->json([ 'menuitems' => $menuitems ]);
    }

    public function getMenuItemsDetails(){
        
        if (request()->has(['menutype', 'menuitemid'])) {

            $menutype   = request()->input('menutype');
            $menuitemid = request()->input('menuitemid');

            switch ($menutype) {
                case 'category':
                $menudetails = Category::findOrFail($menuitemid);
                break;
                
                case 'news':
                $menudetails = News::findOrFail($menuitemid);
                break;
                
                default:
                $menudetails = [];
                break;
            }
        }

        if(request()->ajax()){

            return response()->json([ 'menudetails' => $menudetails ]);
        }
    }
}
