<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register','API\UserController@register' );

Route::get('magasin', 'MagasinController@index');
Route::get('produit','ProduitController@index');
Route::get('categorie', 'CategorieController@index');
Route::get('magasinParCateg/{id}', 'MagasinController@getMagasinFromAppropriateCategorie');
Route::get('typeParCateg/{id}', 'MagasinController@geTypeFromAppropriateCategorieOfMagasin');
Route::get('produitMag/{id}', 'ProduitController@getProductOfAppropriateMagasin');



