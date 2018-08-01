<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','home\IndexController@index');

//前台路由
Route::group(['as'=>'Home::','prefix'=>'home'],function(){
    Route::any('/{class}/{action}', function( $class, $action) {
        $ctrl = \App::make("\\App\\Http\\Controllers\\Home\\" . $class . "Controller");
        return \App::call([$ctrl, $action]);
    });
});

Route::get('admin/login', ['as'=>'login' , 'uses' => 'PublicController@login']);
Route::post('admin/login', ['as'=>'login' , 'uses' => 'PublicController@checkAuth']);
Route::get('admin/logout', 'Auth\AuthController@getLogout');
Route::any('public/upload',['as'=>'upload' , 'uses' => 'PublicController@upload']);


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'Admin::' , 'middleware'=> ['auth','checkPerms']], function(){
    Route::get('/', ['as' => 'index','uses' => 'AdminController@index']);

    //用户管理
    Route::group(['as'=>'Users::', 'prefix'=>'users'], function(){
        Route::any('/',['as'=>'usersIndex','uses'=>'UsersController@index']);
        Route::any('add',['as'=>'usersStore','uses'=>'UsersController@create']);
        Route::any('store',['as'=>'usersStore','uses'=>'UsersController@store']);
        Route::any('edit/{id?}',['as'=>'usersStore','uses'=>'UsersController@edit']);
        Route::any('destroy/{id?}',['as'=>'usersDestroy','uses'=>'UsersController@destroy']);
    });

    //角色管理
    Route::group(['as'=>'Roles::', 'prefix'=>'roles'], function(){
        Route::any('/',['as'=>'rolesIndex','uses'=> 'RolesController@index']);
        Route::any('add',['as'=>'rolesStore','uses'=> 'RolesController@create']);
        Route::any('store',['as'=>'rolesStore','uses'=>'RolesController@store']);
        Route::any('edit/{id?}',['as'=>'rolesStore','uses'=>'RolesController@edit']);
        Route::any('destroy/{id?}',['as'=>'rolesDestroy','uses'=>'RolesController@destroy']);
    });

    //权限管理
    Route::group(['as'=>'Perms::' , 'prefix'=>'permissions'], function(){
        Route::any('/',['as'=>'permsIndex','uses'=> 'PermissionsController@index']);
        Route::any('add',['as'=>'permsStore','uses'=> 'PermissionsController@create']);
        Route::any('store',['as'=>'permsStore','uses'=>'PermissionsController@store']);
        Route::any('edit/{id?}',['as'=>'permsStore','uses'=>'PermissionsController@edit']);
        Route::any('destroy/{id?}',['as'=>'permsDestroy','uses'=>'PermissionsController@destroy']);
    });

    //内容管理
    Route::group(['as'=>'Pages::'],function(){
        Route::any('pagesclass',['as'=>'pagesclassIndex','uses'=>'PagesclassController@index']);
        Route::any('pagesclass/add',['as'=>'pagesclassStore','uses'=> 'pagesclassController@create']);
        Route::any('pagesclass/store',['as'=>'pagesclassStore','uses'=>'pagesclassController@store']);
        Route::any('pagesclass/edit/{id?}',['as'=>'pagesclassStore','uses'=>'pagesclassController@edit']);
        Route::any('pagesclass/destroy/{id?}',['as'=>'pagesclassDestroy','uses'=>'pagesclassController@destroy']);


        Route::any('pages',['as'=>'pagesIndex','uses'=>'PagesController@index']);
        Route::any('pages/add',['as'=>'pagesStore','uses'=> 'PagesController@create']);
        Route::any('pages/store',['as'=>'pagesStore','uses'=>'PagesController@store']);
        Route::any('pages/edit/{id?}',['as'=>'pagesStore','uses'=>'PagesController@edit']);
        Route::any('pages/destroy/{id?}',['as'=>'pagesDestroy','uses'=>'PagesController@destroy']);
        Route::any('pages/allDelete',['as'=>'pagesDestroy','uses'=>'PagesController@allDelete']);

        Route::any('page',['as'=>'pageIndex','uses'=>'PageController@index']);
        Route::any('page/add',['as'=>'pageStore','uses'=> 'PageController@create']);
        Route::any('page/store',['as'=>'pageStore','uses'=>'PageController@store']);
        Route::any('page/edit/{id?}',['as'=>'pageStore','uses'=>'PageController@edit']);
        Route::any('page/destroy/{id?}',['as'=>'pageDestroy','uses'=>'PageController@destroy']);
        Route::any('page/allDelete',['as'=>'pageDestroy','uses'=>'PageController@allDelete']);
    });


    //导航
    Route::group(['as'=>'Menus::', 'prefix'=> 'menus'],function(){
        Route::any('/',['as'=>'menusIndex','uses'=> 'MenusController@index']);
        Route::any('add',['as'=>'menusStore','uses'=> 'MenusController@create']);
        Route::any('store',['as'=>'menusStore','uses'=>'MenusController@store']);
        Route::any('edit/{id?}',['as'=>'menusStore','uses'=>'MenusController@edit']);
        Route::any('destroy/{id?}',['as'=>'menusDestroy','uses'=>'MenusController@destroy']);
    });

    //网站设置
    Route::group(['as'=>'Setting::','prefix'=>'setting'],function (){
        Route::any('/',['as'=>'settingIndex','uses'=> 'SettingController@index']);
        Route::any('store',['as'=>'settingStore','uses'=>'SettingController@store']);
    });

});
