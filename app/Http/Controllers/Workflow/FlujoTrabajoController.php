<?php

namespace App\Http\Controllers\Workflow;

use Alert;
use App\Adicional;
use App\Http\Controllers\Controller;
use App\FlujoTrabajo;
use App\Transicion;
use App\Estado;
use App\Pedido;
use App\Seguimiento;
use Illuminate\Http\Request;

class FlujoTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flus = FlujoTrabajo::all();
        $flujos = collect();
        foreach ($flus as $flu) {
            $uso = false;
            $pedidos = Pedido::all();
            foreach ($pedidos as $pedido) {
                if ($pedido->flujoTrabajo == $flu) {
                    $uso = true;
                    break;
                }
            }
            if ($uso == false) {
                $seguimientos = Seguimiento::all();
                foreach ($seguimientos as $seguimiento) {
                    if ($seguimiento->item->tipoItem->flujoTrabajo == $flu) {
                        $uso = true;
                        break;
                    }
                }
            }

            if ($uso == false) {
                $adicionales = Adicional::all();
                foreach ($adicionales as $adicional) {
                    if ($adicional->item->tipoItem->flujoTrabajo == $flu) {
                        $uso = true;
                    }
                }
            }
            $nuevoFlujo = [$flu, $uso];
            $flujos->push($nuevoFlujo);
        }
        return view('admin_panel.flujo.index', compact('flujos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_panel.flujo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flujo = FlujoTrabajo::create($this->validarFlujo());
        $estados = Estado::all()->pluck('nombre', 'id');
        $uso = false;
        return redirect()->route('workflow.flujos.show', compact('flujo', 'uso'));
    }

    public function asignarTransiciones(FlujoTrabajo $flujo)
    {
        $estados = Estado::all()->pluck('nombre', 'id');
        return view('admin_panel.flujo.asignacion', compact('estados', 'flujo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FlujoTrabajo  $flujoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(FlujoTrabajo $flujo)
    {
        $pedidos = Pedido::all();
        $uso = false;
        if (!$pedidos->isEmpty()) {
            foreach ($pedidos as $pedido) {
                if ($pedido->flujoTrabajo == $flujo) {
                    $uso = true;
                    return view('admin_panel.flujo.show', compact('flujo', 'uso'));
                }
            }
        }
        $seguimientos = Seguimiento::all();
        foreach ($seguimientos as $seguimiento) {
            if ($seguimiento->item->tipoItem->flujoTrabajo == $flujo) {
                $uso = true;
                return view('admin_panel.flujo.show', compact('flujo', 'uso'));
            }
        }
        $adicionales = Adicional::all();
        foreach ($adicionales as $adicional) {
            if ($adicional->item->tipoItem->flujoTrabajo == $flujo) {
                $uso = true;
                return view('admin_panel.flujo.show', compact('flujo', 'uso'));
            }
        }
        return view('admin_panel.flujo.show', compact('flujo', 'uso'));
    }

    public function asignacion(Request $request)
    {
        $flujo = FlujoTrabajo::find($request->flujoTrabajo_id);
        $transiciones = $flujo->transiciones;
        foreach ($transiciones as $tr) {
            if ($tr->nombre == $request->nombre) {
                Alert::error('Error al Asignar Transicion', 'Ya existe una Transicion con ese Nombre');
                return redirect()->back()->with('error', 'Existe una transicion con el mismo nombre')->withInput();
            } elseif ($tr->estadoInicial->id == $request->estadoInicial_id && $tr->estadoFinal->id == $request->estadoFinal_id) {
                Alert::error('Error al Asignar Transicion', 'No pueden existir Transiciones identicas');
                return redirect()->back()->withInput();
            }
        }
        $tr = Transicion::create($this->validarTransicion());
        return redirect()->back()->with('success', 'Transicion Asignada');

        // abort_if($request->estadoInicial_id == $request->estadoFinal_id, 403);
        // $transicion = Transicion::create($request->all());
        // return redirect()->route('workflow.transiciones.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FlujoTrabajo  $flujoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(FlujoTrabajo $flujoTrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FlujoTrabajo  $flujoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlujoTrabajo $flujoTrabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FlujoTrabajo  $flujoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlujoTrabajo $flujo)
    {
        if (!$flujo->transiciones->isEmpty()) {
            foreach ($flujo->transiciones as $transicion) {
                $transicion->delete();
            }
        }
        $flujo->delete();
        Alert::success('Flujo Eliminado correctamente', 'Flujo Eliminado');
        return redirect()->back();
    }

    public function validarFlujo()
    {
        return request()->validate([
            'nombre' => 'unique:flujo_trabajos',
        ]);
    }
    public function validarTransicion()
    {
        return request()->validate([
            'nombre' => 'required',
            'flujoTrabajo_id' => 'required',
            'estadoInicial_id' => 'required',
            'estadoFinal_id' => 'different:estadoInicial_id',
        ], [
            'estadoFinal_id.different' => 'El Estado Final tiene que ser distinto al Inicial'
        ]);
    }
}
