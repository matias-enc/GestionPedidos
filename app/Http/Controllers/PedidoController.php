<?php

namespace App\Http\Controllers;


use Alert;
use App\Categoria;
use App\Estado;
use App\FlujoTrabajo;
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

    public function ver_solicitud(Pedido $pedido)
    {
        return view('admin_panel.pedidos.ver_solicitud', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {

    }
    public function nuevo_pedido()
    {
        $categorias = Categoria::all();
        return view('admin_panel.pedidos.nuevo_pedido', compact('categorias'));
    }

    public function consultar_disponibilidad(Request $request)
    {
        $this->validate($request,[
            'inicial'=> 'required'
        ],[
            'inicial.required' => 'Seleccione una fecha'
        ]);
        $fechaInicial=Carbon::createFromFormat('d/m/Y',$request->inicial);
        $fechaFinal=Carbon::createFromFormat('d/m/Y',$request->final);
        $tipoItem = TipoItem::find($request->tipoItem);
        $items = $tipoItem->items;
        foreach ($items as $key => $item) { //Filtrar items por capacidad
            if($item->capacidad<$request->capacidad && $request->capacidad != ''){
                $items->pull($key);
            }
        }
        $disponible = true;

        if ($tipoItem->nombre!='Secundarios') {
                foreach ($items as $key => $item){ //Filtrar items por disponibilidad

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
                        if($seguimiento->item->capacidad<$request->capacidad){
                            return 'peroncho';
                            $disponible = false;
                        }
                    }
                    if($disponible == false){
                        $items->pull($key);
                    }
                    $disponible = true;

                }
                $items->pluck('nombre', 'id');
                return view('admin_panel.pedidos.asignacion', compact('items', 'fechaInicial', 'fechaFinal', 'tipoItem'));

        }else{
            foreach ($tipoItem->items as $key => $itemSec) { //Filtrar items por disponibilidad en cuanto a su cantidad
                $cantidad = $itemSec->cantidad;
                foreach($itemSec->seguimientos as $seguimiento){
                    $fechaInicialSeg=Carbon::create($seguimiento->fechaInicial);
                    $fechaFinalSeg=Carbon::create($seguimiento->fechaFinal);
                    if(($fechaFinalSeg->greaterThanOrEqualTo($fechaInicial))||($fechaInicialSeg->lessThanOrEqualTo($fechaFinal))||($fechaInicial->equalTo($fechaInicialSeg))){
                        $cantidad = $cantidad - $seguimiento->cantidad;
                    }
                }
                return 'la cantidad para el item:'. $itemSec->nombre. ' es:' . $cantidad;
        }

        }
    }
    function detalle_pedido(Request $request){
        $item = Item::find($request->item_id);
        $fechaInicial = $request->fechaInicial;
        $fechaFinal = $request->fechaFinal;
        return view('admin_panel.pedidos.detalle_pedido', compact('item', 'fechaInicial', 'fechaFinal'));
    }

    function agregar_carrito(Request $request){
        foreach (auth()->user()->pedidos as $pedido) {
            if($pedido->estado->nombre == 'Carrito'){
                $seguimiento = new Seguimiento();
                $seguimiento->pedido_id = $pedido->id;
                $seguimiento->fechaInicial = $request->fechaInicial;
                $seguimiento->fechaFinal = $request->fechaFinal;
                $seguimiento->item_id = $request->item_id;
                $seguimiento->save();
                return redirect()->route('pedidos.nuevo_pedido');
            }
        }

        $pedido = new Pedido();
        $pedido->user_id = auth()->user()->id;
        $workflow = Pedido::first()->flujoTrabajo;
        $pedido->flujoTrabajo_id=$workflow->id;
        $pedido->estado_id = $workflow->estado_inicial()->id;
        $pedido->save();
        $seguimiento = new Seguimiento();
        $seguimiento->pedido_id = $pedido->id;
        $seguimiento->fechaInicial = $request->fechaInicial;
        $seguimiento->fechaFinal = $request->fechaFinal;
        $seguimiento->item_id = $request->item_id;
        $seguimiento->save();
        return redirect()->route('pedidos.nuevo_pedido');
    }

    function listar_carrito(){
        foreach (auth()->user()->pedidos as $pedido) {
            if($pedido->estado->nombre == 'Carrito'){
                return view('admin_panel.pedidos.items_pedido', compact('pedido'));
            }
        }
    }

    function confirmar_pedido(Pedido $pedido){
        $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
        $pedido->save();
        $historial = new Historial();
        $historial->estado_id = $pedido->estado_id;
        $historial->pedido_id = $pedido->id;
        $historial->save();
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
    public function solicitudes()
    {
        $pedidos = Pedido::all();
        foreach ($pedidos as $key => $pedido) {
            if($pedido->estado->nombre != "Solicitado"){
                $pedidos->pull($key);
            }
        }
        return view('admin_panel.pedidos.solicitudes', compact('pedidos'));
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
    public function eliminar_seguimiento(Seguimiento $seguimiento)
    {
        $pedido = $seguimiento->pedido;
        $seguimiento->delete();
        if(sizeOf($pedido->seguimientos) == 0){
            $pedido->delete();
            return redirect()->route('pedidos.nuevo_pedido');
        }
        return back();
    }

}
