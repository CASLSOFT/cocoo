<?php
//Requisiciones
Route::resource('/requisiciones/article', 'Requisiciones\ArticleController', ['except' => ['destroy']]);
Route::get('/requisiciones/articles/list', 'Requisiciones\ArticleController@list')->name('article.list');
Route::get('/requisiciones/articles/search', 'Requisiciones\ArticleController@search')->name('article.search');
// Route::pacth('/requisiciones/article/active/{article}', 'Requisiciones\ArticleController@desactivar')->name('article.active');

//Proveedores
Route::resource('/requisiciones/provider', 'Requisiciones\ProviderController', ['except' => ['destroy', 'edit', 'show']]);

//solicitud de pedidos
Route::view('/requisiciones/papeleria', 'requisiciones.order.stationary.index');
Route::view('/requisiciones/aseo', 'requisiciones.order.cleanliness.index');
Route::view('/requisiciones/cafeteria', 'requisiciones.order.cephetry.index');
Route::view('/requisiciones/drafts', 'requisiciones.order.drafts.index');
Route::view('/requisiciones/approval/user', 'requisiciones.order.approval')->name('approval.order.user');
Route::view('/requisiciones/despacho', 'requisiciones.order.despacho')->name('despacho.order');
Route::view('/requisiciones/shopping', 'requisiciones.order.shopping')->name('shopping.order');

//Informes de pedidos
Route::view('/requisiciones/user/list', 'requisiciones.order.list')->name('lists.orderxuser');


Route::resource('/requisiciones/order', 'Requisiciones\OrderController', ['except' => ['create', 'index']]);
Route::put('/requisiciones/order/send/{order}', 'Requisiciones\OrderController@sendOrder')->name('order.send');// enviamos las ordenes
Route::put('/requisiciones/order/approval/{order}', 'Requisiciones\OrderController@approvalOrder')->name('order.approval');// aprobamos la orden
Route::put('/requisiciones/order/despacho/{order}', 'Requisiciones\OrderController@despachoOrder')->name('order.despacho');//enviamos la orden a despacho
Route::put('/requisiciones/order/recived/{order}', 'Requisiciones\OrderController@receivedOrder')->name('order.recived');//recibimos la orden

Route::resource('/requisiciones/detailorder', 'Requisiciones\DetailOrderController', ['except' => ['edit', 'show', 'create', 'index']]);
Route::get('/requisiciones/ordersxuser/active/{category}', 'Requisiciones\OrderController@activeUser');

Route::get('/requisiciones/ordersxuser/list', 'Requisiciones\OrderController@listUser');
Route::get('/requisiciones/despachos/list', 'Requisiciones\OrderController@listOrderDespacho');
Route::get('/requisiciones/shopping/list', 'Requisiciones\OrderController@listOrderShopping');

Route::get('/requisiciones/ordersxuser/drafts', 'Requisiciones\OrderController@draftsUser');
Route::get('/requisiciones/ordersxuser/drafts/papeleria', 'Requisiciones\OrderController@draftsStationaryUser');
Route::get('/requisiciones/ordersxuser/drafts/aseo', 'Requisiciones\OrderController@draftsCleanlinessUser');
Route::get('/requisiciones/ordersxuser/drafts/cafeteria', 'Requisiciones\OrderController@draftsCephetryUser');
Route::get('/requisiciones/approval/user/area', 'Requisiciones\OrderController@approvalOrderUserArea');