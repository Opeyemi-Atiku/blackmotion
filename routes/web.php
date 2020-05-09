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

Route::get('/', 'PagesController@index');




Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', 'PagesController@profile');
});

Route::get('/contact-us', 'PagesController@contactUs');

Route::post('/contact', 'PagesController@contact');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/questions', 'QuestionsController@questions');

Route::get('/category/{category}', 'PagesController@category');

Route::get('/question/{id}', 'QuestionsController@question');

Route::post('/create-question', 'QuestionsController@create_question');

Route::get('/delete-question/{id}', 'QuestionsController@delete_question');

Route::post('/edit-profile', 'PagesController@edit_profile');

Route::post('/edit-question', 'QuestionsController@edit_question');

Route::post('/answer', 'QuestionsController@answer');

Route::post('/search', 'QuestionsController@search');



Route::get('/user/{id}', 'PagesController@user');

Route::post('/reply', 'PagesController@reply');

Route::get('/newsletter/{email}', 'PagesController@newsletter');

Route::get('/privacy-policy', function () {
    return view('pages.privacy_policy');
});

Route::get('/terms', function () {
    return view('pages.terms');
});

Route::get('/facebook', 'AuthenticationController@getLogin');

Route::get('/create-password', function () {
    return view('pages.createPassword');
});

Route::post('/create-password', 'AuthenticationController@createPassword');

Route::get('/facebook/callback', 'AuthenticationController@facebookCallback');



