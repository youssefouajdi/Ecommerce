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
    Route::get('/panier/{rowId}','CartController@sendmail')->name('cart.sendmail');
    Route::get('/noter/{id}','ProductController@edit')->name('noter');
    Route::post('/noter','ProductController@update')->name('noter.update');
    Route::post('/coupon','CartController@storeCoupon')->name('cart.store.coupon');
    Route::delete('/coupon','CartController@destroyCoupon')->name('cart.destroy.coupon');
    Route::get('/panier','CartController@index')->name('cart.index');
    Route::post('/notif','NotifController@test')->name('notif.test');
    Route::get('notif/list','NotifController@list')->name('notif.list');
    Route::delete('notif/delete/{id}','NotifController@destroy')->name('notif.delete');
    Route::put('notif/update/{id}','NotifController@edit')->name('notif.update');
    Route::put('annonce/update/{id}','AnnoncesController@edit')->name('annonce.update');
    Route::get('/list','AnnoncesController@index')->name('annonce.list');
    Route::get('/paiement','CheckoutController@index')->name('checkout.index');
    Route::post('/paiement','CheckoutController@store')->name('checkout.store');
    Route::get('/merci', 'CheckoutController@thankyou')->name('checkout.thankyou');
    Route::get('/annonce','AnnoncesController@ajoutannonce')->name('partenaire.annonce');
    Route::post('/annonce/create','AnnoncesController@store')->name('partenaire.store');
    Route::delete('/delete/{id}', 'AnnoncesController@destroy')->name('partenaire.delete');
    Route::get('showFromNotification/{product}/{notification}','ProductController@showFromNotification')->name('topics.showFromNotification');
    
});
Route::post('/comments/{product}','CommentController@store')->name('comments.store');
Route::get('/home', 'HomeController@index')->name('home');


