<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/newspaper/admin', function () {
    return view('welcome');
});*/

/*Auto Routes*/
$appUrl = rtrim(config('app.url'),'/');
$url = Url();
$parseUrl = parse_url($appUrl);
$tmpAppUrl = explode('/',$appUrl);
$tmpCurUrl = explode('/',$url->current());
$urlParts = array_slice($tmpCurUrl,count($tmpAppUrl));

$projectUrl = '';
$projectUrl = trim($appUrl, '/');
$projectUrl = preg_replace('#^https?://#', '', rtrim($projectUrl,'/'));
$projectUrl = ltrim(str_replace($parseUrl['host'],'',$projectUrl),'/');

$controller = 'HomeController';
$method = 'index';

if(isset($urlParts[0]) && !empty($urlParts[0]))
    $controller = ucfirst($urlParts[0]).'Controller';
if(isset($urlParts[1]))
    $method = $urlParts[1];

$controller = str_replace('_',' ',$controller);
$controller = str_replace('-',' ',$controller);
$controller = str_replace(' ','',ucwords($controller));

$controller = $controller.'@'.$method;
$namespace = 'App\\Http\\Controllers\\';
/*Auto Routes*/

Route::get($projectUrl.'/error', $namespace.'ErrorController@index');

Route::get($projectUrl.'/login', $namespace.'AuthController@login')->name('login');
Route::post($projectUrl.'/auth', $namespace.'AuthController@auth');
Route::get($projectUrl.'/logout', $namespace.'AuthController@logout');
Route::get($projectUrl.'/ssologin', $namespace.'AuthController@ssologin');
Route::get($projectUrl.'/ssoauth', $namespace.'AuthController@ssoauth');
Route::get($projectUrl.'/ssologout', $namespace.'AuthController@ssologout');

Route::any('{all}', $namespace.$controller)->where('all', '.*')->middleware('session.user'); 




