<?php
//路由
use Clovers\Route\Route;
$router = new Route();
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');
Route::get('user/{id}/comment/{comment_id}', function($id){
    var_dump($id);
});
Route::get('user/{id}/', 'UserController@show');
Route::get('category/{id}/', 'CategoryController@show');
Route::get('test/sql','Test\SqlController@testSql');
Route::get('curl', 'HomeController@testCurlPage');
Route::post('curl', 'HomeController@testCurlPage');
Route::any('test/code/{id?}', 'CodeController@send');
Route::get('view', 'HomeController@view');
Route::get('api/sms', 'ApiController@sendSms');
//启动APP
$router->run();