<?php



Route::get('/', function () {
    return view('welcome');
});
/*route produit*/
Route::get('/boutique','ProductController@index')->name('index');
Route::get('/boutique/{slug}','ProductController@show')->name('show');
Route::post('/panier/ajouter','CartController@store')->name('cart.store');
Route::get('/panier','CartController@index')->name('cart.index');
Route::delete('/panier/{rowid}','CartController@destroy')->name('cart.destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test',function(){
    //$prod=DB::select('SELECT * FROM prods')[0];
    //dd($prod->title);
    $prod=DB::table('prods')->get(['title'])->where('id','>',2)->implode('title',',');
    dd($prod);
    
});