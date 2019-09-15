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
    return redirect('auto_gestion');
});





Auth::routes();

Route::get('/auto_gestion', 'HomeController@index')->name('auto_gestion');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {


    //Route::resource('users', 'UserController');
    Route::get('users', 'UserController@index')->name('users.index')->middleware('has.permission:usuarios_index');
    Route::get('users/create','UserController@create')->name('users.create')->middleware('has.permission:usuarios_create')  ;
    Route::post('users','UserController@store')->name('users.store')->middleware('has.permission:usuarios_create') ;
    Route::get('users/{user}','UserController@show')->name('users.show')->middleware('has.permission:usuarios_show') ;
    Route::get('users/{id}/edit' , 'UserController@edit')->name('users.edit')->middleware('has.permission:usuarios_edit');
    Route::put('users/{user}' , 'UserController@update')->name('users.update')->middleware('has.permission:usuarios_update');
    Route::delete('users/{id}' , 'UserController@destroy')->name('users.destroy')->middleware('has.permission:usuarios_destroy') ;

    //Rutas Roles
    Route::get('roles', 'RolController@index')->name('roles.index')->middleware('has.permission:roles_index');
    Route::get('roles/create','RolController@create')->name('roles.create')->middleware('has.permission:roles_create')  ;
    Route::post('roles','RolController@store')->name('roles.store')->middleware('has.permission:roles_create') ;
    Route::get('roles/{rol}','RolController@show')->name('roles.show')->middleware('has.permission:roles_show') ;
    Route::get('roles/{id}/edit' , 'RolController@edit')->name('roles.edit')->middleware('has.permission:roles_edit');
    Route::put('roles/{rol}' , 'RolController@update')->name('roles.update')->middleware('has.permission:roles_update');
    Route::delete('roles/{id}' , 'RolController@destroy')->name('roles.destroy')->middleware('has.permission:roles_destroy') ;

    //Rutas Permisos
    Route::get('permisos', 'PermissionController@index')->name('permisos.index')->middleware('has.permission:permisos_index');
    Route::get('permisos/create','PermissionController@create')->name('permisos.create')->middleware('has.permission:permisos_create')  ;
    Route::post('permisos','PermissionController@store')->name('permisos.store')->middleware('has.permission:permisos_create') ;
    Route::get('permisos/{permiso}','PermissionController@show')->name('permisos.show')->middleware('has.permission:permisos_show') ;
    Route::get('permisos/{permiso}/edit' , 'PermissionController@edit')->name('permisos.edit')->middleware('has.permission:permisos_edit');
    Route::put('permisos/{permiso}' , 'PermissionController@update')->name('permisos.update')->middleware('has.permission:permisos_update');
    Route::delete('permisos/{permiso}' , 'PermissionController@destroy')->name('permisos.destroy')->middleware('has.permission:permisos_destroy') ;

});

//Rutas Flujo de Trabajo
Route::group(['prefix' => 'workflow', 'as' => 'workflow.', 'namespace' => 'Workflow', 'middleware' => ['auth']], function () {
    Route::get('transiciones', 'TransicionController@index')->name('transiciones.index');
    Route::get('transiciones/create','TransicionController@create')->name('transiciones.create');
    Route::post('transiciones','TransicionController@store')->name('transiciones.store');
    Route::delete('transiciones/{transicion}' , 'TransicionController@destroy')->name('transiciones.destroy');

    Route::get('flujos', 'FlujoTrabajoController@index')->name('flujos.index');
    Route::get('flujos/create', 'FlujoTrabajoController@create')->name('flujos.create');
    Route::get('flujos/{flujo}/asignar', 'FlujoTrabajoController@asignarTransiciones')->name('flujos.asignarTransiciones');
    Route::post('flujos/asignacion', 'FlujoTrabajoController@asignacion')->name('flujos.asignacion');
    Route::post('flujos','FlujoTrabajoController@store')->name('flujos.store');
    Route::get('flujos/{flujo}','FlujoTrabajoController@show')->name('flujos.show');

});



//Rutas de Pedidos
Route::group(['middleware' => ['auth']], function () {

    //Rutas de Administracion de Pedidos

    Route::get('pedidos/index', 'PedidoController@index')->name('pedidos.index');
    Route::get('pedidos/{pedido}','PedidoController@show')->name('pedidos.show');


    //Rutas de Pedidos de un usuario y funcionalidades
    Route::get('mis_pedidos', 'PedidoController@pedidos_usuario')->name('pedidos.mis_pedidos');
    Route::get('nuevo_pedido', 'PedidoController@nuevo_pedido')->name('pedidos.nuevo_pedido');
    Route::post('consultar_disponibilidad', 'PedidoController@consultar_disponibilidad')->name('pedidos.consultar_disponibilidad');
    Route::post('detalle_pedido', 'PedidoController@detalle_pedido')->name('pedidos.detalle_pedido');
    Route::post('confimar_pedido','PedidoController@confirmar_pedido')->name('pedidos.confirmar_pedido');
    Route::get('mis_pedidos/{pedido}','PedidoController@seguimiento')->name('pedidos.seguimiento');
});
