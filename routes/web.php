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



Auth::routes();

//test
Route::post('loginme', 
  ['as' => 'loginme', 'uses' => 'LoginController@login']);

Route::post('changePass', 
  ['as' => 'changePass', 'uses' => 'LoginController@changePass']);

Route::get('sayhello/{name}', function($name){
 echo 'Hello Laravel! I am '.$name;
});

//MyFirstController
Route::get('controller/{stn}/{sth}', 'MyFirstController@getController');
Route::get('controllertest/{stn}/{sth}', 'MyFirstController@testController');
Route::get('data', 'MyFirstController@data');
Route::get('demo', 'MyFirstController@demo');
Route::get('view/{stn}/{sth}', 'MyFirstController@getView');

Route::get('form', 'MyFirstController@getForm');
Route::get('khachview/{n}', 'MyFirstController@getKhach');
Route::group(['prefix' => 'book'], function(){
	Route::get('add', 'MyFirstController@addBook');
	Route::get('update/{stn}', 'MyFirstController@updateBook');
        Route::get('delete/{stn}', 'MyFirstController@deleteBook');
});
Route::group(['prefix' => 'customer'], function(){
	Route::get('add', 'MyFirstController@addCustomer');
        Route::get('view/{stn}', 'MyFirstController@viewCustomer');
	Route::get('update/{stn}', 'MyFirstController@updateCustomer');
        Route::get('delete/{stn}', 'MyFirstController@deleteCustomer');
});

Route::post('mselect', 
  ['as' => 'mselect', 'uses' => 'MyFirstController@mselect']);
Route::get('bookForm', 
  ['as' => 'bookForm', 'uses' => 'FormController@create']);
Route::post('bookForm', 
  ['as' => 'bookForm_store', 'uses' => 'FormController@store']);
Route::get('customerForm', 
  ['as' => 'customerForm', 'uses' => 'FormController@customerCreate']);
Route::post('customerForm', 
  ['as' => 'customerForm_store', 'uses' => 'FormController@customerStore']);
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'MyFirstController@Loginon');
Route::get('/Bookview/{n}','MyFirstController@Bookview');
Route::get('notfound', 
  ['as' => 'notfound', 'uses' => 'MyFirstController@Notfound']);
Route::get('/userInfo','MyFirstController@userInfo');

Route::get('pageNumberB', 
  ['as' => 'pageNumberB', 'uses' => 'FormController@pageNumberB']);
Route::get('pageNumberC', 
  ['as' => 'pageNumberC', 'uses' => 'FormController@pageNumberC']);
Route::get('pageNumberD', 
  ['as' => 'pageNumberD', 'uses' => 'FormController@pageNumberD']);
Route::post('BookuploadForm', 
  ['as' => 'BookuploadForm', 'uses' => 'UploadController@BookuploadForm']);
Route::post('upload', 'UploadController@upload');
Route::get('uploadimg', 'UploadController@index');
Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
Route::get('/output','MyFirstController@output');

//Excel

Route::get('/BookExport','ExcelController@BookExport');
Route::get('/ExcelView','ExcelController@ExcelView');
Route::get('/seleteDate','ExcelController@seleteDate');
Route::post('CustomerExport', 
  ['as' => 'CustomerExport', 'uses' => 'ExcelController@CustomerExport']);

//Book
    Route::get('/BookGive/{n}','BookController@BookGive');
    
Route::get('/changeBookTag/{n}','BookController@changeTag');
Route::get('/BookGive2/{n}','BookController@BookGive2');
Route::get('/getBookForm/{n}','BookController@getBookForm');

Route::get('/getinfoB/{n}','BookController@showBook');
Route::get('/getinfoBbyname/{n}','BookController@showBookbyname');
Route::get('/insertCustomer','BookController@insertCustomer');

Route::get('/updateinfoB/{n}','BookController@updateBook');
Route::get('/updateinfoTestB/{n}','BookController@updateBookTest');
Route::post('updateB', 
  ['as' => 'updateB_store', 'uses' => 'BookController@updateB']);
Route::get('/deleteB/{n}','BookController@deleteB');
Route::get('/insertBook','BookController@insertBook');
Route::post('insertB', 
  ['as' => 'insertB_store', 'uses' => 'BookController@insertB']);
Route::post('AjaxBookUpload', 
  ['as' => 'AjaxBookUpload', 'uses' => 'UploadController@AjaxBookUpload']);

//Route::get('/getinfoTestB/{n}','BookController@showBookTest');


//customer
Route::get('/insertCustomer','CustomerController@insertCustomer');
Route::get('/getinfoC/{n}','CustomerController@showCustomer');
Route::get('/updateinfoC/{n}','CustomerController@updateCustomer');
Route::get('/deleteC/{n}','CustomerController@deleteC');
Route::post('updateC', 
  ['as' => 'updateC_store', 'uses' => 'CustomerController@updateC']);
Route::post('insertC', 
  ['as' => 'insertC_store', 'uses' => 'CustomerController@insertC']);

//Deal
Route::get('/DealView/{n}','DealController@index');

Route::get('/insertDeal','DealController@insertDeal');
Route::post('insertD', 
  ['as' => 'insertD_store', 'uses' => 'DealController@insertD']);
Route::get('/getinfoD/{n}','DealController@showDeal');
Route::get('/updateinfoD/{n}','DealController@updateDeal');

Route::post('updateD', 
  ['as' => 'updateD_store', 'uses' => 'DealController@updateD']);
Route::get('/deleteD/{n}','DealController@deleteD');
Route::get('/DealEnd/{n}','DealController@DealEnd');
Route::get('/HistoryCustomer/{id}/{n}','DealController@HistoryCustomer');
Route::get('/HistoryBook/{id}/{n}','DealController@HistoryBook');
Route::get('sortby', 
  ['as' => 'sortby', 'uses' => 'DealController@sortby']);
//Ajax

//Route::get('/BookGive/{n}','AjaxController@BookGive');
//Route::get('/BookGive2/{n}','AjaxController@BookGive2');
//Route::get('/getBookForm/{n}','AjaxController@getBookForm');
//
//Route::get('/getinfoB/{n}','AjaxController@showBook');
//Route::get('/getinfoBbyname/{n}','AjaxController@showBookbyname');
//Route::get('/insertCustomer','AjaxController@insertCustomer');
//
//Route::get('/updateinfoB/{n}','AjaxController@updateBook');
//Route::post('updateB', 
//  ['as' => 'updateB_store', 'uses' => 'AjaxController@updateB']);
//Route::get('/deleteB/{n}','AjaxController@deleteB');
//Route::get('/insertBook','AjaxController@insertBook');
//Route::post('insertB', 
//  ['as' => 'insertB_store', 'uses' => 'AjaxController@insertB']);
//Route::post('AjaxBookUpload', 
//  ['as' => 'AjaxBookUpload', 'uses' => 'UploadController@AjaxBookUpload']);

Route::get('ajax',function(){
   return view('ajax');
});
Route::get('/getmsg','AjaxController@index');

//Route::get('/getinfoC/{n}','AjaxController@showCustomer');
//Route::get('/updateinfoC/{n}','AjaxController@updateCustomer');
//Route::get('/deleteC/{n}','AjaxController@deleteC');
//Route::post('updateC', 
//  ['as' => 'updateC_store', 'uses' => 'AjaxController@updateC']);
//Route::post('insertC', 
//  ['as' => 'insertC_store', 'uses' => 'AjaxController@insertC']);


//TypeTagManager
Route::get('/TypeTagManager','TypeController@index');
Route::get('/changeTag/{n}','TypeController@changeTag');
Route::get('/deleteType/{n}','TypeController@deleteType');
Route::post('insertType', 
  ['as' => 'insertType', 'uses' => 'TypeController@insertType']);
Route::post('updateType', 
  ['as' => 'updateType', 'uses' => 'TypeController@updateType']);

Route::get('/deleteTag/{n}','TypeController@deleteTag');
Route::post('insertTag', 
  ['as' => 'insertTag', 'uses' => 'TypeController@insertTag']);
Route::post('updateTag', 
  ['as' => 'updateTag', 'uses' => 'TypeController@updateTag']);