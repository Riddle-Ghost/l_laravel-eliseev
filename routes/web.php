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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/email/verify/{token}', 'Auth\RegisterController@verify')->name('verification.verify');

Route::group(
    [
        'prefix' => 'cabinet',
        'as' => 'cabinet.',
        'namespace' => 'Cabinet',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('home');
            Route::get('/edit', 'ProfileController@edit')->name('edit');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::post('/phone', 'PhoneController@request');
            Route::get('/phone', 'PhoneController@form')->name('phone');
            Route::put('/phone', 'PhoneController@verify')->name('phone.verify');

            Route::post('/phone/auth', 'PhoneController@auth')->name('phone.auth');
        });

        Route::get('favorites', 'FavoriteController@index')->name('favorites.index');
        Route::delete('favorites/{advert}', 'FavoriteController@remove')->name('favorites.remove');

        Route::resource('tickets', 'TicketController')->only(['index', 'show', 'create', 'store', 'destroy']);
        Route::post('tickets/{ticket}/message', 'TicketController@message')->name('tickets.message');
    }
);

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('users', 'UsersController');
        Route::post('users/{user}/verify', 'UsersController@verify')->name('users.verify');

        Route::resource('regions', 'RegionController');

        Route::group(['prefix' => 'adverts', 'as' => 'adverts.', 'namespace' => 'Adverts'], function () {

            Route::resource('categories', 'CategoryController');

            Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
                Route::post('/first', 'CategoryController@first')->name('first');
                Route::post('/up', 'CategoryController@up')->name('up');
                Route::post('/down', 'CategoryController@down')->name('down');
                Route::post('/last', 'CategoryController@last')->name('last');
                Route::resource('attributes', 'AttributeController')->except('index');
            });

            Route::group(['prefix' => 'adverts', 'as' => 'adverts.'], function () {
                Route::get('/', 'AdvertController@index')->name('index');
                Route::get('/{advert}/edit', 'AdvertController@editForm')->name('edit');
                Route::put('/{advert}/edit', 'AdvertController@edit');
                Route::get('/{advert}/photos', 'AdvertController@photosForm')->name('photos');
                Route::post('/{advert}/photos', 'AdvertController@photos');
                Route::get('/{advert}/attributes', 'AdvertController@attributesForm')->name('attributes');
                Route::post('/{advert}/attributes', 'AdvertController@attributes');
                Route::post('/{advert}/moderate', 'AdvertController@moderate')->name('moderate');
                Route::get('/{advert}/reject', 'AdvertController@rejectForm')->name('reject');
                Route::post('/{advert}/reject', 'AdvertController@reject');
                Route::delete('/{advert}/destroy', 'AdvertController@destroy')->name('destroy');
            });
        });
    }
);
