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
Route::get('/home', function () {
    return redirect('auto_gestion');
});
Route::get('/pdf', function () {
    $pdf = PDF::loadView('admin_panel.pdf.pedidos');
    return $pdf->stream();
    // return view('admin_panel.pdf.layout');
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
    Route::delete('users/{user}' , 'UserController@destroy')->name('users.destroy')->middleware('has.permission:usuarios_destroy') ;




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

    Route::get('estados', 'EstadoController@index')->name('estados.index');
    Route::get('estados/{estado}', 'EstadoController@show')->name('estados.show');
    Route::get('estados/create','EstadoController@create')->name('estados.create');
    Route::post('estados','EstadoController@store')->name('estados.store');
    Route::delete('estados/{estado}' , 'EstadoController@destroy')->name('estados.destroy');

    Route::get('flujos', 'FlujoTrabajoController@index')->name('flujos.index');
    Route::get('flujos/create', 'FlujoTrabajoController@create')->name('flujos.create');
    Route::get('flujos/{flujo}/asignar', 'FlujoTrabajoController@asignarTransiciones')->name('flujos.asignarTransiciones');
    Route::post('flujos/asignacion', 'FlujoTrabajoController@asignacion')->name('flujos.asignacion');
    Route::post('flujos','FlujoTrabajoController@store')->name('flujos.store');
    Route::get('flujos/{flujo}','FlujoTrabajoController@show')->name('flujos.show');
});



//Rutas de Pedidos
Route::group(['middleware' => ['auth']], function () {

    //Rutas de conversion de Reportes
    Route::post('pedidos/reporte', 'PedidoController@reporte')->name('pedidos.reporte');
    Route::post('auditoria/reporte', 'AuditoriaController@reporte')->name('auditoria.reporte');


    //Rutas de Administracion de Pedidos

    Route::get('pedidos/index', 'PedidoController@index')->name('pedidos.index');
    Route::get('pedidos/estadisticas', 'PedidoController@estadisticas')->name('pedidos.estadisticas');
    Route::get('pedidos/{pedido}','PedidoController@show')->name('pedidos.show');

    //Rutas de Pedidos de un usuario y funcionalidades
    Route::get('mis_pedidos', 'PedidoController@pedidos_usuario')->name('pedidos.mis_pedidos');
    Route::get('nuevo_pedido', 'PedidoController@nuevo_pedido')->name('pedidos.nuevo_pedido');
    Route::post('consultar_disponibilidad', 'PedidoController@consultar_disponibilidad')->name('pedidos.consultar_disponibilidad');
    Route::post('disponibilidad_secundarios', 'PedidoController@disponibilidad_secundarios')->name('pedidos.disponibilidad_secundarios');
    Route::post('detalle_pedido', 'PedidoController@detalle_pedido')->name('pedidos.detalle_pedido');
    Route::post('agregar_carrito', 'PedidoController@agregar_carrito')->name('pedidos.agregar_carrito');
    Route::get('confimar_pedido/{pedido}','PedidoController@confirmar_pedido')->name('pedidos.confirmar_pedido');
    Route::get('mis_pedidos/{pedido}','PedidoController@seguimiento')->name('pedidos.seguimiento');
    Route::get('listar_carrito','PedidoController@listar_carrito')->name('pedidos.listar_carrito');
    Route::delete('listar_carrito/{seguimiento}' , 'PedidoController@eliminar_seguimiento')->name('pedidos.eliminar_seguimiento');
    Route::delete('listar_carrito/seguimiento/{adicional}' , 'PedidoController@eliminar_adicional')->name('pedidos.eliminar_adicional');
    Route::post('generar_pedido', 'PedidoController@generar_pedido')->name('pedidos.generar_pedido');

    //Solicitudes
    Route::get('solicitudes','PedidoController@solicitudes')->name('pedidos.solicitudes');
    Route::get('solicitudes/{pedido}','PedidoController@ver_solicitud')->name('pedidos.ver_solicitud');
    Route::post('asignar','PedidoController@asignar_estado')->name('pedidos.asignar_estado');
    Route::post('finalizar_pedido','PedidoController@finalizar_pedido')->name('pedidos.finalizar_pedido');
    Route::get('cantidad_solicitudes' , 'PedidoController@cantidad_solicitudes')->name('cantidad_solicitudes');

    //Pedidos pendientes del Usuario
    Route::get('cantidad_pendientes' , 'PedidoController@cantidad_pendientes')->name('cantidad_pendientes');
    Route::get('pendientes','PedidoController@pendientes')->name('pedidos.pendientes');
    Route::get('pendientes/{pedido}','PedidoController@ver_pendiente')->name('pedidos.ver_pendiente');
    Route::get('pendientes/{pedido}/generar_pdf','PedidoController@generar_documentacion')->name('pedidos.generar_documentacion');

    //Pedidos Iniciados
    Route::get('iniciados','PedidoController@iniciados')->name('pedidos.iniciados');
    Route::get('cantidad_iniciados' , 'PedidoController@cantidad_iniciados')->name('cantidad_iniciados');
    Route::get('iniciados/{pedido}','PedidoController@ver_iniciado')->name('pedidos.ver_iniciado');
    Route::get('iniciados/generar_documentacion_historial/{historial}','PedidoController@generar_documentacion_historial')->name('pedidos.generar_documentacion_historial');
    Route::post('iniciados/asignar_documentacion_historial/{historial}','PedidoController@asignar_documentacion_historial')->name('pedidos.asignar_documentacion_historial');
    Route::post('asignar_seguimiento','PedidoController@asignar_estado_seguimiento')->name('pedidos.asignar_estado_seguimiento');
    Route::post('asignar_estado_general','PedidoController@asignar_estado_general')->name('pedidos.asignar_estado_general');
    Route::post('asignar_adicional','PedidoController@asignar_estado_adicional')->name('pedidos.asignar_estado_adicional');


    //Pedidos En Revision
    Route::get('revision','PedidoController@revision')->name('pedidos.revision');
    Route::get('revision/{pedido}','PedidoController@ver_revision')->name('pedidos.ver_revision');
    Route::get('cantidad_revision' , 'PedidoController@cantidad_revision')->name('cantidad_revision');
    Route::post('procesar_revision','PedidoController@procesar_revision')->name('pedidos.procesar_revision');

    //Pedidos en espera de Pago
    Route::get('cantidad_pagopendiente' , 'PedidoController@cantidad_pagopendiente')->name('cantidad_pagopendiente');
    Route::get('pago_pendiente','PedidoController@pago_pendiente')->name('pedidos.pago_pendiente');
    Route::get('pago_pendiente/{pedido}','PedidoController@ver_pago_pendiente')->name('pedidos.ver_pago_pendiente');
    Route::get('procesar_pago/{id}/','PedidoController@procesar_pago')->name('pedidos.procesar_pago');

    //Rutas Configuracion Usuario
    Route::get('mi_perfil' , 'PedidoController@mi_perfil')->name('mi_perfil');
    Route::post('actualizar_perfil' , 'PedidoController@actualizar_perfil')->name('actualizar_perfil');


    //Validacion de Usuario
    Route::get('validacion_datos' , 'ValidacionController@validacion_datos')->name('validacion_datos');
    Route::post('cargar_datos' , 'ValidacionController@cargar_datos')->name('cargar_datos');
    Route::post('enviar_datos' , 'ValidacionController@enviar_datos')->name('enviar_datos');
    Route::post('aceptar_validacion/{validacion}' , 'ValidacionController@aceptar_validacion')->name('aceptar_validacion');
    Route::post('cancelar_validacion/{validacion}' , 'ValidacionController@cancelar_validacion')->name('cancelar_validacion');
    Route::get('cantidad_validaciones' , 'ValidacionController@cantidad_validaciones')->name('cantidad_validaciones');
    Route::get('validacion_pendiente','ValidacionController@validacion_pendiente')->name('validacion_pendiente');
    Route::get('validacion_pendiente/{validacion}','ValidacionController@ver_validacion_pendiente')->name('ver_validacion_pendiente');

    //Auditorias
    Route::get('auditoria', 'AuditoriaController@index')->name('auditoria.index');
    Route::get('auditoria/{auditoria}-{id}', 'AuditoriaController@show')->name('auditoria.show');

    //get jquery para index
    Route::get('cantidad_carrito' , 'PedidoController@cantidad_carrito')->name('cantidad_carrito');

    //CONFIGURACIONES DEL SISTEMA
    Route::get('configuraciones_sistema' , 'ConfiguracionController@configuraciones_sistema')->name('configuraciones_sistema');
    Route::post('actualizar_informacion' , 'ConfiguracionController@actualizar_informacion')->name('actualizar_informacion');
    Route::post('actualizar_penalizacion' , 'ConfiguracionController@actualizar_penalizacion')->name('actualizar_penalizacion');

});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('item', 'ItemController');
    Route::post('fileUpload/{item}', 'ItemController@fileUpload')->name('fileUpload');
    Route::get('borrar_imagen/{imagen}' , 'ItemController@borrar_imagen')->name('borrar_imagen');

});
Route::fallback(function(){
    return view('errors.404');
});
