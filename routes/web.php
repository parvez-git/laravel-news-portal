<?php

Route::get('/', 'FrontController@index')->name('home');
Route::get('/page/category/{slug}', 'FrontController@pageCategory')->name('page.category');
Route::get('/page/news/{slug}', 'FrontController@pageNews')->name('page.news');
Route::get('/page', 'FrontController@pageArchive')->name('page');
Route::get('/page/search', 'FrontController@pageSearch')->name('page.search');

// AUTHENTICATION 
Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@authenticate')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/register', 'RegisterController@register')->name('register');
Route::post('/register', 'RegisterController@registration')->name('register');

// SOCIAL LOGIN
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

// 404
Route::get('/nopermission', function(){ return back(); })->name('nopermission');

// ONLY ADMIN
Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => ['auth','roles'], 'roles' => ['admin']], function(){

    Route::resource('users','UsersController');

    Route::resource('settings','SettingController')->only(['index','store']);
    Route::get('settings/breakingnews','SettingController@breakingNews')->name('settings.breakingnews');
    Route::post('settings/breakingnews/store','SettingController@storeBreakingNews')->name('settings.breakingnews.store');

    Route::resource('advertisements','AdvertisementController')->only(['index','store']);

    Route::resource('menus','MenuController');
    Route::post('menuitems-json','MenuController@getMenuItems')->name('menuitems.json');
    Route::post('menuitemsdetails-json','MenuController@getMenuItemsDetails')->name('menuitemsdetails.json');
    
});

// BOTH EDITOR AND ADMIN
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['auth','roles'],'roles'=>['editor','admin']], function(){
    
    Route::resource('category','CategoryController');
    Route::resource('news','NewsController');
});

// USER, EDITOR AND ADMIN
Route::group(['middleware'=>['auth','roles'],'roles'=>['user','editor','admin']], function(){

    Route::get('/dashboard', function(){ return view('backend.dashboard'); })->name('dashboard');

    Route::get('profile','ProfileController@profile')->name('profile');
    Route::post('profile','ProfileController@profileUpdate')->name('profile.update');
    Route::post('changepassword','ProfileController@changePassword')->name('profile.changepassword');
});
