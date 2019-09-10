<?php

namespace App\Http\Controllers\Workflow;
use Alert;
use App\Estado;
use App\FlujoTrabajo;
use App\Transicion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransicionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transiciones = Transicion::all();
        return view('admin_panel.transiciones.index', compact('transiciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transicion = new Transicion();
        $estados = Estado::all()->pluck('nombre', 'id');
        $flujos = FlujoTrabajo::all()->pluck('nombre', 'id');
        return view('admin_panel.transiciones.create', compact('estados','flujos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $transicion = Transicion::create($this->validarTransicion());
        return redirect()->route('workflow.transiciones.index');
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
        $transicion->delete();

        return back();
    }
    public function validarTransicion(){
        return request()->validate([
            'nombre' => 'required',
            'flujoTrabajo_id' => 'required',
            'estadoInicial_id' => 'required',
            'estadoFinal_id' => 'different:estadoInicial_id|required',
        ]);
    }


}
