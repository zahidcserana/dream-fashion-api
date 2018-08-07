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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Product Basic
Route::get('/products', 'ProductsController@products')->name('products');
Route::get('/product-list', 'ProductsController@productList')->name('product-list');
Route::get('/add-product/{id?}', 'ProductsController@addProduct')->name('add-product');
Route::post('/add-product', 'ProductsController@add')->name('add-product');
Route::get('/product-delete/{id}', 'ProductsController@delete')->name('product-delete');
// Product Image
Route::post('/product_image', 'ImagesController@add')->name('product_image');

// Size
Route::get('/size/{id?}', 'SizesController@index')->name('size');
Route::get('/size-delete/{id}', 'SizesController@delete')->name('size-delete');
Route::post('/size', 'SizesController@add')->name('size');
// Color
Route::get('/color/{id?}', 'ColorsController@index')->name('color');
Route::get('/color-delete/{id}', 'ColorsController@delete')->name('color-delete');
Route::post('/color', 'ColorsController@add')->name('color');
// Brand
Route::get('/brand/{id?}', 'BrandController@index')->name('brand');
Route::get('/brand-delete/{id}', 'BrandController@delete')->name('brand-delete');
Route::post('/brand', 'BrandController@add')->name('brand');
// Category
Route::get('/category/{id?}', 'CategoriesController@index')->name('category');
Route::get('/category-delete/{id}', 'CategoriesController@delete')->name('category-delete');
Route::post('/category', 'CategoriesController@add')->name('category');
// Sub Category
Route::get('/sub-category/{id?}', 'CategoriesController@indexSub')->name('sub-category');
Route::get('/sub-category-delete/{id}', 'CategoriesController@deleteSub')->name('sub-category-delete');
Route::post('/sub-category', 'CategoriesController@addSub')->name('sub-category');
Route::get('/get-sub-cat-by-cat', 'CategoriesController@getSubCatByCat')->name('get-sub-cat-by-cat');
// Sub Sub Category
Route::get('/sub-sub-category/{id?}', 'CategoriesController@indexSubSub')->name('sub-sub-category');
Route::get('/sub-sub-category-delete/{id}', 'CategoriesController@deleteSubSub')->name('sub-sub-category-delete');
Route::post('/sub-sub-category', 'CategoriesController@addSubSub')->name('sub-sub-category');
Route::get('/get-sub-sub-cat-by-sub-cat', 'CategoriesController@getSubSubCatBySubCat')->name('get-sub-sub-cat-by-sub-cat');
