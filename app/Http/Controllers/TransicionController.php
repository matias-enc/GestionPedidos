<?php

namespace App\Http\Controllers;

use App\Estado;
use App\FlujoTrabajo;
use App\Transicion;
use Illuminate\Http\Request;

class TransicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flujo = FlujoTrabajo::find(1);
        return view('admin_panel.transiciones.index', compact('flujo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transicion = new Transicion();
        $estado1 = Estado::all()->pluck('nombre', 'id');
        $estado2 = Estado::all()->pluck('nombre', 'id');
        $flujos = FlujoTrabajo::all()->pluck('nombre', 'id');
        return view('admin_panel.transiciones.create', compact('estado1', 'estado2','flujos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if($request->estadoInicial == $request->estadoFinal, 403);
        $transicion = Transicion::create($request->all());
        return redirect()->route('transiciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transicion  $transicion
     * @return \Illuminate\Http\Response
     */
    public function show(Transicion $transicion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transicion  $transicion
     * @return \Illuminate\Http\Response
     */
    public function edit(Transicion $transicion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transicion  $transicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transicion $transicion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transicion  $transicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transicion $transicion)
    {
        //
    }



}
