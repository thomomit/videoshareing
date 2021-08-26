<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

/** TOP */
Route::get('/', 'TPostController@top')->name("top");

/** VIDEO LIST */
Route::get('/video-list/{key?}', 'TPostController@list')
    ->name("video-list");

/** VIDEO POST */
Route::get('/mypage/post', 'TPostController@post')
    ->name("post");  

/** VIDEO CREATE API(SAVE TO DB) */
Route::post('/video-save', 'TPostController@video_save');

/** VIDEO EDIT */
Route::get('/mypage/edit/{post_id}', 'TPostController@edit')
    ->name("edit");

/** VIDEO UPDATE API */
Route::put('/edit/{post_id}', 'TPostController@tryUpdate')->name('try.update');

/** VIDEO DELETE API */
Route::put('/delete/{post_id}', 'TPostController@tryDelete')->name('try.delete');

/** VIDEO MANAGE */
Route::get('/manage', 'TPostController@manage')
    ->name("manage");

/**
 * GET VIDEO DATA
 * /video/[t_post.converted]
 * .env.CONVERT_PATH./t_post.converted
 */
Route::get('/video/{filename}', function ($filename){
    $path = config('app.convert').$filename;
    return response()->file($path);
});

/**
 * GET THUMNAME DATA
 * /thumbnail/[t_post.thumbnail]
 * .env.CONVERT_PATH./t_post.thumbnail
 */
Route::get('/thumbnail/{filename}', function ($filename){
    $path = config('app.convert').$filename;
    return response()->file($path);
});

/** MAKE THUMNAME API(NEW ONE) */
Route::get ('/convert', 'TPostController@convertVideo');

/** LIKE API */
Route::post('/api/likeIt', 'TLikeController@likeIt');

/** VIEW COUNT API */
Route::post('/view', 'TPostController@view');