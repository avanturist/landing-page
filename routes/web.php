<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function (){
    //home
    Route::match(['get','post'], '/', ['uses'=>'Admin\IndexController@execute', 'as'=>'home']);
    //роутер для кнопки на сторінці home
    Route::get('/page/{alias}',['uses'=>'Admin\PageController@execute','as'=>'page']);

});

//admin/
Auth::routes();
Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){
   //login
    Route::get('/',['uses'=>'Admin\AdminController@execute']);
    //admin
    Route::get('/', ['uses'=>'Admin\AdminController@show', 'as'=>'admin']);

    //admin/pages
    Route::get('/pages', ['uses'=>'Admin\PagesController@showPage','as'=>'pages']);
    //admin/addPage
    Route::match(['get','post'], '/pages/addPage',['uses'=>'Admin\PagesController@addPage', 'as'=>'addPage']);
    //admin/edit/{page}
    Route::group(['prefix'=>'/page/edit'], function (){
        //show form  edit with page in input
        Route::get('/', ['uses'=>'Admin\PagesController@showEditPage', 'as'=>'editP']);

        Route::match(['get','post'],'/{page}', ['uses'=>'Admin\PagesController@editPage', 'as'=>'editPage']);


    });
    Route::post('/pages/{page_id}',['uses'=>'Admin\PagesController@deletePage', 'as'=>'deletePage']);



    /*PORTFOLIO*/
    //admin/portfolio
    Route::get('/portfolio', ['uses'=>'Admin\PortfolioController@execute', 'as'=>'portfolios']);

    //admin/portfolio/add_potrfolio
    Route::match(['get','post'], '/portfolio/add_portfolio', ['uses'=>'Admin\PortfolioController@addPortfolio', 'as'=>'addPortfolio']);
    //admin/portfolio/edit_portfolio
    Route::match(['get','post','delete'], 'portfolio/edit_portfolio/{id_portf}', ['uses'=>'Admin\PortfolioController@editPortfolio', 'as'=>'editPortfolio']);

});
