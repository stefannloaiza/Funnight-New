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

// GENERALES
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@ratingData')->name('home.rating');

// USUARIO
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');
Route::get('/seguir/{site_id}', 'UserController@seguir')->name('seguir');
Route::get('/dejarSeguir/{site_id}', 'UserController@dejarSeguir')->name('dejarSeguir');

Route::get('/gustosview', 'UserController@gustosview')->name('user.gustosview');
Route::get('/gustos', 'UserController@gustos')->name('user.gustos');

// Establecimiento
Route::get('/sites', 'EstablecimientoController@index')->name('sites.index');
Route::get('/sites/create', 'EstablecimientoController@create')->name('sites.create');
Route::get('/sites/edit', 'EstablecimientoController@edit')->name('sites.edit');
Route::get('/sites/show', 'EstablecimientoController@show')->name('sites.show');
Route::post('/sites/store', 'EstablecimientoController@store')->name('sites.store');
Route::post('/sites/update', 'EstablecimientoController@update')->name('sites.update');

// IMAGEN
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/image/existFile/{filename}', 'ImageController@existImage')->name('image.exist');
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::get('/countLikes/{image_id}', 'ImageController@countLikesImage')->name('image.countLike');
Route::post('/image/update', 'ImageController@update')->name('image.update');

// COMENTARIOS
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('/comment/update/{id}', 'CommentController@update')->name('actualizarcomentario');
Route::post('/comment/edit', 'CommentController@edit')->name('comment.edit');

// LIKES
Route::get('/likes', 'LikeController@index')->name('likes');
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');

// REPORTE PDF
Route::get('/reporte/top', 'ReportController@topusuarios')->name('topusers');

// CIUDAD
Route::get('/ajaxGetCiudad', 'CiudadController@ajaxGetCiudad');

// Administrador

Route::get('/administracion', 'ReportController@admin')->name('administrar');
Route::get('/admin', 'UserController@index')->name('admin.index');

// RATINGS
Route::get('rating/{user_id}/{ratingData}', 'UserController@ratingUser');

// REPORTE EXCEL

Route::get('/reporte/products', 'ReportController@index')->name('topusersexcel');
Route::get('descargar-productos', 'ReportController@excel')->name('topusersexcel.excel');
