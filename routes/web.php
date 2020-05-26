<?php



Route::get('/', function () {
    return view('welcome');
});
/*route produit*/
Route::get('/boutique','ProductController@index')->name('index');
Route::get('/boutique/{slug}','ProductController@show')->name('show');
Route::post('/panier/ajouter','CartController@store')->name('cart.store');
Route::patch('/panier/{rowId}','CartController@update')->name('cart.update');
Route::delete('/panier/{rowid}','CartController@destroy')->name('cart.destroy');
Route::get('/search','ProductController@search')->name('products.search');
Auth::routes();
Route::group(['middleware'=>['auth']],function(){
    Route::get('/panier','CartController@index')->name('cart.index');
    Route::post('/notif','NotifController@test')->name('notif.test');
    Route::get('/list','AnnoncesController@index')->name('annonce.list');
    Route::get('notif/list','NotifController@list')->name('notif.list');
    Route::get('/paiement','CheckoutController@index')->name('checkout.index');
    Route::post('/paiement','CheckoutController@store')->name('checkout.store');
    Route::get('/merci', 'CheckoutController@thankyou')->name('checkout.thankyou');
    Route::get('/annonce','AnnoncesController@ajoutannonce')->name('partenaire.annonce');
    Route::post('/annonce/create','AnnoncesController@store')->name('partenaire.store');
    Route::delete('/delete/{id}', 'AnnoncesController@destroy')->name('partenaire.delete');
});
Route::get('/home', 'HomeController@index')->name('home');


/*
Route::get('/test',function(){
    //$prod=DB::select('SELECT * FROM prods')[0];
    //dd($prod->title);
    $prod=DB::table('prods')->get(['title'])->where('id','>',2)->implode('title',',');
    dd($prod);
    
});*/