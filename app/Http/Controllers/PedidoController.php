<?php

namespace App\Http\Controllers;


use PDF;
use Alert;
use App\Adicional;
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
use App\Events\PedidoSolicitado;
use App\User;
use Illuminate\Notifications\Notification;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();
        $usuarios = collect();
        foreach (User::all() as $usuario) {
            if (sizeof($usuario->pedidos) > 0) {
                $usuarios->push($usuario);
            }
        }
        $items = collect();
        foreach (Item::all() as $item) {
            if ($item->cantidad == null) {
                $items->push($item);
            }
        }
        $pedidos = Pedido::all()->where('user_id', '!=', null);
        return view('admin_panel.pedidos.index', compact('pedidos', 'estados', 'usuarios', 'items'));
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
    public function reporte(Request $request)
    {
        $pedidos = Pedido::all()->where('user_id', '!=', null);
        // return $request;
        $usuario = null;
        $item = null;
        $estado = null;
        $llegada = null;
        $salida = null;
        if ($request->estado_id != null) {
            $estado = Estado::find($request->estado_id);
            foreach ($pedidos as $id => $pedido) {
                if ($pedido->estado->id != $request->estado_id) {
                    $pedidos->pull($id);
                }
            }
        }
        if ($request->usuario_id != null) {
            $usuario = User::find($request->usuario_id);
            foreach ($pedidos as $id => $pedido) {
                if ($pedido->usuario->id != $request->usuario_id) {
                    $pedidos->pull($id);
                }
            }
        }
        if ($request->item_id != null) {
            $item = Item::find($request->item_id);
            foreach ($pedidos as $id => $pedido) {
                foreach ($pedido->seguimientos as $seguimiento) {
                    if ($seguimiento->item->id != $request->item_id) {
                        $pedidos->pull($id);
                    }
                }
            }
        }
        if ($request->llegada != null) {
            $llegada = Carbon::createFromFormat('d/m/Y', $request->llegada);
            $llegada->setTime(0, 0, 0);
            $salida = Carbon::createFromFormat('d/m/Y', $request->salida);
            $salida->setTime(0, 0, 0);
            foreach ($pedidos as $id => $pedido) {
                foreach ($pedido->seguimientos as $seguimiento) {
                    $llegadaPedido = $pedido->getFechaInicial();

                    $salidaPedido = $pedido->getFechaFinal();
                    $llegadaPedido->setTime(0, 0, 0);
                    $salidaPedido->setTime(0, 0, 0);
                    if (($salidaPedido->greaterThanOrEqualTo($llegada) && $salidaPedido->lessThanOrEqualTo($salida)) && ($llegadaPedido->greaterThanOrEqualTo($llegada) && $llegadaPedido->lessThanOrEqualTo($salida))) { } else {
                        $pedidos->pull($id);
                    }
                }
            }
            $llegada = $llegada->format('d/m/Y');
            $salida = $salida->format('d/m/Y');
        }




        $pdf = PDF::loadView('admin_panel.pdf.pedidos', compact('pedidos', 'usuario', 'item', 'estado', 'llegada', 'salida'));
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $y = $canvas->get_height() - 35;
        $pdf->getDomPDF()->get_canvas()->page_text(500, $y, "Pagina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
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

    public function ver_iniciado(Pedido $pedido)
    {
        return view('admin_panel.pedidos.ver_iniciado', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    { }
    public function nuevo_pedido()
    {

        $tipoItems = TipoItem::all()->where('categoria_id', 1);
        return view('admin_panel.pedidos.nuevo_pedido', compact('tipoItems'));
    }

    public function consultar_disponibilidad(Request $request)
    {
        // return $request;
        if ($request->tipoItem != null) {
            $tipoItem = TipoItem::find($request->tipoItem);
            if ($tipoItem->nombre != 'Albergues') {
                $this->validar_eventos();
            } else {
                $this->validar_pedido();
            }
        } else {
            $this->validar_pedido();
        }
        $fechaInicial = Carbon::createFromFormat('d/m/Y', $request->inicial);
        $fechaFinal = Carbon::createFromFormat('d/m/Y', $request->final);
        $fechaInicial->setTime(0, 0, 0);
        $fechaFinal->setTime(0, 0, 0);


        $disponible = true;

        //TODO PARA MANEJO DE HORAS EN ALBERGUES
        if ($tipoItem->nombre == 'Albergues') {
            $tipoItem = TipoItem::find($request->tipoItem);
            $items = $tipoItem->items;
            foreach ($items as $key => $item) { //Filtrar items por capacidad
                if ($item->capacidad < $request->capacidad) {
                    $items->pull($key);
                }
            }
            if ($fechaInicial->equalTo($fechaFinal)) {
                $fechaInicial->addHours(9);
                $fechaFinal->addHours(32);
            } else {
                $fechaInicial->addHours(9);
                $fechaFinal->addHours(8);
            }
        //MANEJO DE HORAS PARA COMPLEJOS
        } else {
            // return $request->hora_inicial;
            $fechaInicial = Carbon::createFromFormat('d/m/Y H:i A', $request->inicial.' '.$request->hora_inicial);
            $fechaFinal = Carbon::createFromFormat('d/m/Y H:i A', $request->final.' '.$request->hora_final);
            $items = $tipoItem->items;
        }
        foreach ($items as $key => $item) { //Filtrar items por disponibilidad

            foreach ($item->seguimientos as $seguimiento) {
                $fechaInicialSeg = Carbon::create($seguimiento->fechaInicial);
                $fechaFinalSeg = Carbon::create($seguimiento->fechaFinal);
                if (($fechaInicial->greaterThan($fechaInicialSeg) && $fechaInicial->greaterThanOrEqualTo($fechaFinalSeg)) || ($fechaInicial->lessThan($fechaInicialSeg) && $fechaFinal->lessThanOrEqualTo($fechaInicialSeg))) {
                    $disponible = true;
                } elseif ($fechaInicial->equalTo($fechaInicialSeg)) {
                    $disponible = false;
                } else {
                    $disponible = false;
                }
                if ($seguimiento->item->capacidad < $request->capacidad) {
                    $disponible = false;
                }
            }
            if ($disponible == false) {
                $items->pull($key);
            }
            $disponible = true;
        }
        if (sizeof($items) <= 0) {
            Alert::error('No hay disponibilidad', 'En esta fecha no se encontro el item solicitado');
            return redirect()->back()->withInput();
        }
        $items->pluck('nombre', 'id');
        return view('admin_panel.pedidos.asignacion', compact('items', 'fechaInicial', 'fechaFinal', 'tipoItem'));
    }
    function detalle_pedido(Request $request)
    {
        $item = Item::find($request->item_id);
        $fechaInicial = $request->fechaInicial;
        $fechaFinal = $request->fechaFinal;
        if ($item->tipoItem->nombre == 'Albergues') {
            $diferencia = Carbon::create($fechaInicial)->diffInDays(Carbon::create($fechaFinal)) + 1;
        }else{
            $diferencia = Carbon::create($fechaInicial)->diffInHours(Carbon::create($fechaFinal));
        }

        // return $fechaInicial . $fechaFinal;
        return view('admin_panel.pedidos.detalle_pedido', compact('item', 'fechaInicial', 'fechaFinal', 'diferencia'));
    }

    function disponibilidad_secundarios(Request $request)
    {
        $seguimiento = Seguimiento::find($request->seguimiento);
        $item = Item::find($request->item_id);
        $fechaInicial = Carbon::create($seguimiento->fechaInicial);
        $fechaFinal = Carbon::create($seguimiento->fechaFinal);
        $cantidad = $item->cantidad;
        foreach ($item->adicionales as $adicional) {
            $fechaInicialSeg = Carbon::create($adicional->seguimiento->fechaInicial);
            $fechaFinalSeg = Carbon::create($adicional->seguimiento->fechaFinal);
            if (($fechaInicial->greaterThan($fechaInicialSeg) && $fechaInicial->greaterThanOrEqualTo($fechaFinalSeg)) || ($fechaInicial->lessThan($fechaInicialSeg) && $fechaFinal->lessThanOrEqualTo($fechaInicialSeg))) {
                //No se resta
            } elseif ($fechaInicial->equalTo($fechaInicialSeg)) {
                $cantidad -= $adicional->cantidad;
            } else {
                $cantidad -= $adicional->cantidad;
            }
        }
        if ($cantidad < $request->cantidad) {
            Alert::error('Error al Asignar', 'No contamos con esa Cantidad de Items')->persistent();
            return redirect()->back();
        } else {
            $guardado = false;
            foreach ($seguimiento->adicionales as $adicional) {
                if ($adicional->item->id == $request->item_id) {
                    $adicional->cantidad += $request->cantidad;
                    $adicional->update();
                    $guardado = true;
                }
            }
            if ($guardado == false) {
                $adicional = new Adicional();
                $adicional->seguimiento_id = $seguimiento->id;
                $adicional->item_id = $item->id;
                $adicional->cantidad = $request->cantidad;
                $adicional->save();
            }
            Alert::success('Item asignado', 'Se han agregado correctamente ' . $item->nombre);
            return redirect()->back();
        }
    }

    function agregar_carrito(Request $request)
    {
        // return $request->fechaInicial . $request->fechaFinal;
        foreach (auth()->user()->pedidos as $pedido) {
            if ($pedido->estado->nombre == 'Carrito') {
                $seguimiento = new Seguimiento();
                $seguimiento->pedido_id = $pedido->id;
                $seguimiento->fechaInicial = $request->fechaInicial;
                $seguimiento->fechaFinal = $request->fechaFinal;
                $seguimiento->item_id = $request->item_id;
                $seguimiento->save();
                return redirect()->route('pedidos.listar_carrito');
            }
        }

        $pedido = new Pedido();
        $pedido->user_id = auth()->user()->id;
        $workflow = FlujoTrabajo::where('nombre', 'Pedidos')->firstOrFail();
        // $workflow = Pedido::first()->flujoTrabajo;
        $pedido->flujoTrabajo_id = $workflow->id;
        $pedido->estado_id = $workflow->estado_inicial()->id;
        $pedido->save();
        $seguimiento = new Seguimiento();
        $seguimiento->pedido_id = $pedido->id;
        $seguimiento->fechaInicial = $request->fechaInicial;
        $seguimiento->fechaFinal = $request->fechaFinal;
        $seguimiento->item_id = $request->item_id;
        $seguimiento->save();
        return redirect()->route('pedidos.listar_carrito');
    }

    function listar_carrito()
    {
        foreach (auth()->user()->pedidos as $pedido) {
            if ($pedido->estado->nombre == 'Carrito') {
                $secundarios = TipoItem::find(4)->items;
                return view('admin_panel.pedidos.items_pedido', compact('pedido', 'secundarios'));
            }
        }
    }

    function confirmar_pedido(Pedido $pedido)
    {
        $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
        $pedido->save();
        $historial = new Historial();
        $historial->estado_id = $pedido->estado_id;
        $historial->pedido_id = $pedido->id;
        $historial->save();
        event(new PedidoSolicitado('Nuevo Pedido Solicitado para su Revision'));
        return redirect()->route('pedidos.mis_pedidos');
    }

    function asignar_estado(Request $request)
    {
        $pedido = Pedido::find($request->pedido);
        $historial = Historial::create();
        $historial->estado_id = $request->estado;
        $historial->pedido_id = $pedido->id;
        $historial->save();
        $pedido->estado_id = $request->estado;
        $pedido->save();
        return redirect()->route('pedidos.solicitudes')->with('success', 'Pedido Guardado');
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
        $estado = Estado::where('nombre', 'Solicitado')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id)->sortBy('FechaInicial');
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
        if (sizeof($seguimiento->adicionales) != 0) {
            foreach ($seguimiento->adicionales as $adicional) {
                $adicional->delete();
            }
        }
        $seguimiento->delete();
        if (sizeOf($pedido->seguimientos) == 0) {
            $pedido->delete();
            return redirect()->route('pedidos.nuevo_pedido');
        }
        return back();
    }
    public function eliminar_adicional(Adicional $adicional)
    {
        $adicional->delete();
        return back();
    }

    public function finalizar_pedido(Request $request)
    {
        // return $request;
        $pedido = Pedido::find($request->pedido_id);
        $historial = Historial::create();
        $pedido->estado_id = $pedido->flujoTrabajo->estado_final()->id;
        $historial->pedido_id = $pedido->id;
        $historial->estado_id = $pedido->estado_id;
        $historial->save();
        $pedido->save();
        Alert::success('Se han finalizado el pedido correctamente', 'Pedido Guardado ');
        return redirect()->route('pedidos.solicitudes');
    }

    public function iniciados()
    {

        $estado = Estado::where('nombre', 'Iniciado')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id)->sortBy('FechaInicial');
        // $pedidos;
        // return $pedidos;
        return view('admin_panel.pedidos.iniciados', compact('pedidos'));
    }

    public function actualizar_perfil(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->dni = $request->dni;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Cuenta Actualizada');
    }

    public function mi_perfil()
    {
        $user = auth()->user();
        return view('admin_panel.usuarios.perfil', compact('user'));
    }

    public function cantidad_solicitudes()
    {
        return sizeof(Pedido::all()->where('estado_id', 6));
    }

    public function cantidad_iniciados()
    {
        $estado = Estado::where('nombre', 'Iniciado')->firstOrFail();
        return sizeof(Pedido::all()->where('estado_id', $estado->id));
    }

    public function validar_pedido()
    {
        return request()->validate([
            'inicial' => 'required',
            'final' => 'required',
            'capacidad' => 'required',
            'tipoItem' => 'required',
        ]);
    }
    public function validar_eventos()
    {
        return request()->validate([
            'inicial' => 'required',
            'final' => 'required',
            'hora_inicial' => 'required',
            'hora_final' => 'required',
            'tipoItem' => 'required',
        ]);
    }
}
