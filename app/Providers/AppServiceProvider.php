<?php

namespace App\Providers;

use App\Menu;
use App\News;
use App\Setting;
use App\Category;
use App\Advertisement;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        if (! $this->app->runningInConsole()) {

            view()->composer(
                [
                    'frontend.layout.partials.header',
                    'frontend.layout.partials.footer'
                ], 
                function($view) {
                $view->with('headersettings', Setting::first());
                $view->with('headerads', Advertisement::get());
            });

            view()->composer('frontend.layout.partials.mainmenu', function($view) {
                $menus = Menu::all()->groupBy('parent_id');
                $view->with('mainmenus', $menus);
            });

            view()->composer('frontend.layout.partials.header', function($view) {
                $categoryid = Setting::first();
                $newstickers = News::latest()->whereHas('category')->where('category_id',$categoryid->breaking_news_category_id)->where('status',1)->get();
                $view->with('newstickers', $newstickers);
            });

            view()->composer('frontend.layout.partials.footer', function($view) {
                $view->with('footernewscategorylist', Category::has('newslist')->withCount('newslist')->orderBy('name','desc')->where('status',1)->get());
            });

            view()->composer('frontend.pages.sidebar', function($view) {

                $newscategory_two   = News::latest()->whereHas('category')->where('category_id',5)->where('status',1)->take(3)->get();
                
                $newstabspopular    = News::orderBy('view_count','DESC')->whereHas('category')->where('status',1)->take(5)->get();
                $newstabsrecent     = News::latest()->whereHas('category')->where('status',1)->take(5)->get();
                $newsinRandomOrder  = News::inRandomOrder()->whereHas('category')->where('status',1)->first();
                $newscategory_list  = Category::has('newslist')->withCount('newslist')->orderBy('name','desc')->where('status',1)->get();

                $view->with( compact(
                    'newscategory_two',

                    'newstabspopular',
                    'newstabsrecent',
                    'newsinRandomOrder',
                    'newscategory_list'
                ));
            });

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
