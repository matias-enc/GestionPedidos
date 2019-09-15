<?php

namespace App\Http\Controllers;


use Alert;
use App\Historial;
use App\Pedido;
use App\Item;
use App\Seguimiento;
use App\TipoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
    public function nuevo_pedido()
    {
        $tipoItems = TipoItem::all()->pluck('nombre', 'id');
        return view('admin_panel.pedidos.nuevo_pedido', compact('tipoItems'));
    }

    public function consultar_disponibilidad(Request $request)
    {
        $this->validate($request,[
            'inicial'=> 'required',
            'final'=> 'required'
        ]);
        $fechaInicial=Carbon::createFromFormat('d/m/Y',$request->inicial);
        $fechaFinal=Carbon::createFromFormat('d/m/Y',$request->final);
        $tipoItem = TipoItem::find($request->tipoItem);
        $items = $tipoItem->items;
        foreach ($items as $item){
            foreach($item->seguimientos as $seguimiento){
                $fechaInicialSeg=Carbon::create($seguimiento->fechaInicial);
                $fechaFinalSeg=Carbon::create($seguimiento->fechaFinal);
                if(($fechaInicial->greaterThan($fechaInicialSeg) && $fechaInicial->greaterThanOrEqualTo($fechaFinalSeg)) || ($fechaInicial->lessThan($fechaInicialSeg) && $fechaFinal->lessThanOrEqualTo($fechaInicialSeg))){
                    $disponible = true;
                }elseif($fechaInicial->equalTo($fechaInicialSeg)){
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
        $items->pluck('nombre', 'id');
        return view('admin_panel.pedidos.asignacion', compact('items', 'fechaInicial', 'fechaFinal', 'tipoItem'));

    }
    function detalle_pedido(Request $request){
        $item = Item::find($request->item_id);
        $fechaInicial = $request->fechaInicial;
        $fechaFinal = $request->fechaFinal;
        return view('admin_panel.pedidos.detalle_pedido', compact('item', 'fechaInicial', 'fechaFinal'));
    }
    function confirmar_pedido(Request $request){
        $pedido = new Pedido();
        $pedido->user_id = auth()->user()->id;
        $pedido->estado_id = 5; //CAMBIAR HARDCODEADO DURO - INSTANCIAR WORKFLOW DE PEDIDO
        $pedido->save();
        $historial = new Historial();
        $historial->estado_id = $pedido->estado_id;
        $historial->pedido_id = $pedido->id;
        $historial->save();
        $seguimiento = new Seguimiento();
        $seguimiento->pedido_id = $pedido->id;
        $seguimiento->fechaInicial = $request->fechaInicial;
        $seguimiento->fechaFinal = $request->fechaFinal;
        $seguimiento->item_id = $request->item_id;
        $seguimiento->save();
        return redirect()->route('pedidos.mis_pedidos');
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
        $historiales = $pedido->historiales;
        return view('admin_panel.pedidos.seguimiento', compact('historiales'));
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
