<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
         $permisos = Permission::all();

         return view('admin_panel.permisos.index', compact('permisos'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {

         return view('admin_panel.permisos.create', compact('permisos'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

         $permiso = Permission::create($request->all());

         return redirect()->route('permisos.index');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show(Permission $permiso)
     {
         return view('admin_panel.permisos.show', compact('permiso'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit(Permission $permiso)
     {
         return view('admin_panel.permisos.edit', compact('permiso'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Permission $permiso)
     {
         $permiso->update($request->all());

         return redirect()->route('permisos.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Permission $permiso)
     {
         $permiso->delete();

         return back();
     }
}
