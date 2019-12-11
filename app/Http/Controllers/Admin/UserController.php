<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Pais;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view('admin_panel.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');

        return view('admin_panel.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {



        $paises = Pais::all();
        return view('admin_panel.usuarios.show', compact('user', 'paises'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all()->pluck('name', 'id');

        return view('admin_panel.usuarios.edit', compact('roles', 'user'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        alert()->success('success', 'Usuario Editado!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id != $user->id) {
            if (sizeof($user->pedidos)>0) {
                Alert::error('No pueden eliminar un Usuario con Pedidos Realizados', 'Error al Eliminar Usuario')->persistent();
                return back();
            }
            if($user->validacion->aprobado == true){
                Alert::error('No pueden eliminar un Usuario que esta validado dentro del Sistema!', 'Error al Eliminar Usuario')->persistent();
                return back();
            }elseif($user->validacion->estado== 'Pendiente'){
                Alert::warning('No pueden eliminar un Usuario que ha solicitado su validacion!', 'Usuario con Validacion Pendiente')->persistent();
                return back();
            }

            // $user->delete();
            return back();
        } else {
            Alert::error('No puede eliminarse a usted mismo', 'Error al Eliminar Usuario')->persistent();
            return back();
        }
    }
}
