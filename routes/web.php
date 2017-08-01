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

//Ajax

Route::get('/BookGive/{n}','AjaxController@BookGive');
Route::get('/BookGive2/{n}','AjaxController@BookGive2');
Route::get('/getBookForm/{n}','AjaxController@getBookForm');
Route::get('ajax',function(){
   return view('ajax');
});
Route::get('/getmsg','AjaxController@index');

Route::get('/getinfoC/{n}','AjaxController@showCustomer');
Route::get('/updateinfoC/{n}','AjaxController@updateCustomer');
Route::get('/deleteC/{n}','AjaxController@deleteC');
Route::post('updateC', 
  ['as' => 'updateC_store', 'uses' => 'AjaxController@updateC']);
Route::post('insertC', 
  ['as' => 'insertC_store', 'uses' => 'AjaxController@insertC']);

Route::get('/getinfoB/{n}','AjaxController@showBook');
Route::get('/getinfoBbyname/{n}','AjaxController@showBookbyname');
Route::get('/insertCustomer','AjaxController@insertCustomer');

Route::get('/updateinfoB/{n}','AjaxController@updateBook');
Route::post('updateB', 
  ['as' => 'updateB_store', 'uses' => 'AjaxController@updateB']);
Route::get('/deleteB/{n}','AjaxController@deleteB');
Route::get('/insertBook','AjaxController@insertBook');
Route::post('insertB', 
  ['as' => 'insertB_store', 'uses' => 'AjaxController@insertB']);
Route::post('AjaxBookUpload', 
  ['as' => 'AjaxBookUpload', 'uses' => 'UploadController@AjaxBookUpload']);

