<?php

namespace App\Http\Controllers;

use Alert;
use App\Calificacion;
use App\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function actualizar_informacion(Request $request)
    {
        // return $request;
        $configuracion = Configuracion::all()->first();
        $this->validar_informacion();
        $configuracion->nombre = $request->nombre;
        $configuracion->telefono = $request->telefono;
        $configuracion->direccion = $request->direccion;
        $configuracion->save();
        Alert::success('Se ha actualizado la configuracion inicial', 'Configuracion Actualizada');
        return redirect()->back();
    }

    public function configuraciones_sistema()
    {
        $configuracion = Configuracion::all()->first();
        $calificaciones = Calificacion::all();
        // return $configuracion;
        return view('admin_panel.configuraciones.sistema', compact('configuracion', 'calificaciones'));
    }

    public function actualizar_penalizacion(Request $request)
    {
        // return $request->calificaciones;
        $this->validar_calificaciones();
        $calificaciones = Calificacion::all();
        foreach ($calificaciones as $id => $calificacion) {
            $calificacion->penalizacion = $request->calificaciones[$id];
            $calificacion->save();
        }
        Alert::success('Se han actualizado las calificaciones', 'Configuracion Actualizada');
        return redirect()->back();
    }

    public function validar_calificaciones()
    {
        return request()->validate([
            'calificaciones.*' => 'min:0|max:10000',
        ]);
    }
    public function validar_informacion()
    {
        return request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracion $configuracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracion $configuracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracion $configuracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        //
    }
}
