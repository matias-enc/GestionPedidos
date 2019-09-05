<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

         $roles = Role::all();

         return view('admin_panel.roles.index', compact('roles'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $permisos = Permission::all()->pluck('name', 'id');

         return view('admin_panel.roles.create', compact('permisos'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

         $rol = Role::create($request->all());
         $rol->permissions()->sync($request->input('permisos', []));

         return redirect()->route('admin.roles.index');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show(Role $rol)
     {
         return view('admin_panel.roles.show', compact('rol'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $rol = Role::find($id);
         $permissions = Permission::all()->pluck('name','id');

         return view('admin_panel.roles.edit', compact('permissions', 'rol'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Role $rol)
     {
        //  $rol = Role::find($id);
         $rol->update($request->all());
         $rol->permissions()->sync($request->input('permissions', []));

         return redirect()->route('admin.roles.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Role $rol)
     {
         $rol->delete();

         return back();
     }
}
