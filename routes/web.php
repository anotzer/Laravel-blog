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

Route::get('/', function () {
    return view('welcome');
});

// 'namespace' => 'Blog',
Route::group([ 'prefix' => 'blog'], function () {
    Route::resource('posts', 'CommentaryController')->names('blog.posts');
});

Auth::routes();


// Администрирование блога
$groupData = [
    'namespace' => 'Blog\admin',
    'prefix'    =>  'admin/blog',
];
/*
    * index - categories list
    * edit - categories edit page
    * update - save categories
    * create - categories create & goto store
*/
Route::group($groupData, function(){
    //category
    $methods = ['index','edit','update','create','store',];
    Route::resource('categories','CategoryController')->only($methods)->names('blog.admin.categories');

    //posts
    Route::resource('posts', 'PostController')
        ->except('show')
        ->names('blog.admin.posts');
});
// на этом оно заканчивается :D


Route::get('/home', 'HomeController@index')->name('home');

