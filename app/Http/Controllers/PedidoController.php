<?php

namespace App\Http\Controllers;


use Alert;
use App\Pedido;
use App\Item;
use App\Seguimiento;
use App\TipoItem;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('admin_panel.pedidos.index', compact('pedidos'));
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
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return view('admin_panel.pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }
    public function index_items()
    {
        $tipoItems = TipoItem::all()->pluck('nombre', 'id');
        return view('admin_panel.pedidos.index_items', compact('tipoItems'));
    }

    public function consultar_disponibilidad(Request $request)
    {
        // $fechaInicial=$request->inicial;
        // $fechaFinal=$request->final;
        // $seguimientos = Seguimiento::all();
        // foreach ($seguimientos as $seguimiento) {
        //     if($request->tipoItem==$seguimiento->item->tipoItem->id){
        //         $fechaInicialSeg=\Carbon\Carbon::parse($seguimiento->fechaInicial)->format('d/m/Y');
        //         $fechaFinalSeg=\Carbon\Carbon::parse($seguimiento->fechaFinal)->format('d/m/Y');
        //         if(($fechaInicial>$fechaInicialSeg && $fechaInicial >= $fechaFinalSeg) || ($fechaInicial<$fechaInicialSeg && $fechaFinal <= $fechaInicialSeg)){
        //             // Agregar item aca a array
        //         }elseif($fechaInicial==$fechaInicialSeg){
        //             Alert::error('No hay Disponibilidad en la fecha Seleccionada', '');
        //             return redirect()->back()->withInput();
        //         }else{
        //             Alert::error('No hay Disponibilidad en la fecha Seleccionada', '');
        //             return redirect()->back()->withInput();
        //         }
        //     }
        // }
        $fechaInicial=$request->inicial;
        $fechaFinal=$request->final;
        $items = TipoItem::find($request->tipoItem)->items;
        foreach ($items as $item){
            foreach($item->seguimientos as $seguimiento){
                $fechaInicialSeg=\Carbon\Carbon::parse($seguimiento->fechaInicial)->format('d/m/Y');
                $fechaFinalSeg=\Carbon\Carbon::parse($seguimiento->fechaFinal)->format('d/m/Y');
                if(($fechaInicial>$fechaInicialSeg && $fechaInicial >= $fechaFinalSeg) || ($fechaInicial<$fechaInicialSeg && $fechaFinal <= $fechaInicialSeg)){
                    $disponible = true;
                }elseif($fechaInicial==$fechaInicialSeg){
                    $disponible = false;
                }else{
                    $disponible = false;
                }
            }
            if($disponible == false){
                $items->pull($item->id-1);
            }
            $disponible = true;
        }
        return $items->pluck('nombre');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    public function pedidos_usuario(Request $request, Pedido $pedido)
    {
        $pedidos = auth()->user()->pedidos;
        return view('admin_panel.pedidos.mis_pedidos', compact('pedidos'));
    }

    public function seguimiento(Pedido $pedido)
    {
        $seguimientos = $pedido->seguimientos;
        return view('admin_panel.pedidos.seguimiento', compact('pedido', 'seguimientos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
