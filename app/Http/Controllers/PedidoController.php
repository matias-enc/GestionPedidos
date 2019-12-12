<?php

namespace App\Http\Controllers;


use PDF;
use Alert;
use App\Adicional;
use App\Calificacion;
use App\Categoria;
use App\Estado;
use App\Events\PedidoPendiente;
use App\FlujoTrabajo;
use App\Historial;
use App\Pedido;
use App\Item;
use App\Seguimiento;
use App\TipoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\PedidoSolicitado;
use App\HistorialAdicional;
use App\HistorialSeguimiento;
use App\Reputacion;
use App\User;
use App\Charts\PedidosChart;
use Jenssegers\Date\Date;
// use Illuminate\Support\Facades\Date;

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
        $pedidos = Pedido::all()->where('user_id', '!=', null)->sortBy('FechaInicial');
        return view('admin_panel.pedidos.index', compact('pedidos', 'estados', 'usuarios', 'items'));
    }
    public function estadisticas()
    {
        $colores = collect();
        $colores->add('#1e4af7');
        $colores->add('#0fbe6c');
        $colores->add('#EC547A');
        $colores->add('#FF790E');
        // return $colores;

        $iniciado = Estado::where('nombre', 'Iniciado')->firstOrFail();
        $iniciados = sizeof(Pedido::all()->where('estado_id', $iniciado->id));
        $solicitado = Estado::where('nombre', 'Solicitado')->firstOrFail();
        $solicitados = sizeof(Pedido::all()->where('estado_id', $solicitado->id));
        $pagopendiente = Estado::where('nombre', 'Pago Pendiente')->firstOrFail();
        $pagospendientes = sizeof(Pedido::all()->where('estado_id', $pagopendiente->id));
        $finalizado = Estado::where('nombre', 'Finalizado')->firstOrFail();
        $finalizados = sizeof(Pedido::all()->where('estado_id', $finalizado->id));
        $chart = new PedidosChart;

        $tipoItem = TipoItem::where('nombre', 'Albergues')->firstOrFail();
        $items = $tipoItem->items;
        $habitaciones = array();
        $habita = collect();
        $ocurrencias = collect();
        foreach ($items as $id => $item) {
            $hab = $item->nombre;
            $habita->push($item);
            array_push($habitaciones, $hab);
            $oc = sizeof(Seguimiento::all()->where('item_id', $item->id));
            $ocurrencias->add($oc);
        }
        $dc = $colores->random();
        $chart->dataset('Cantidad de Ocurrencias', 'bar', $ocurrencias)->color($dc)->backgroundColor($dc);
        $chart->labels = $habitaciones;
        $chart->barWidth(0.25);
        // return $iniciados;

        //////HABITACION MAS SOLICITADA EN QUE FECHAS
        $habitacion = $habita->first();
        $ocurrencias = collect();
        $meses = array();
        for ($i = 01; $i <= 12; $i++) {
            $ha= $i + 1;
            if($i<10){
                $desde ='2019-0'. $i .'-01';
                $hasta ='2019-0'. $ha .'-01';
            }else{
                $desde ='2019-'. $i .'-01';
                $hasta ='2019-'. $ha .'-01';
            }

            // return $desde . $hasta;
            $from = date($desde);
            $to = date($hasta);
            $ocurrencia = sizeof(Seguimiento::all()->where('item_id', $habitacion->id)->whereBetween('fechaInicial', [$from, $to]));
            $ocurrencias->push($ocurrencia);
            array_push($meses, Carbon::create()->month($i)->format('F'));
        }
        // return Carbon::create()->month(1)->format('F');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $ocurrenciass = [2,3,2,13,7,8,1,23,12,1,5,$ocurrencias[11]];
        $chart2 = new PedidosChart;
        $chart2->dataset('Ocurrencias', 'line', $ocurrenciass)->color($dc);
        $chart2->labels = $meses;
        $chart2->barWidth(0.25);
        return view('admin_panel.pedidos.estadisticas', compact('iniciados', 'solicitados', 'pagospendientes', 'finalizados', 'chart' , 'chart2'));
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



        $nombre = 'Reporte-Pedidos-' . Carbon::now()->format('d/m/Y G:i') . '.pdf';
        $pdf = PDF::loadView('admin_panel.pdf.pedidos', compact('pedidos', 'usuario', 'item', 'estado', 'llegada', 'salida'));
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $y = $canvas->get_height() - 35;
        $pdf->getDomPDF()->get_canvas()->page_text(500, $y, "Pagina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download($nombre);
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
        if ($pedido->estado->nombre == 'Solicitado') {
            return view('admin_panel.pedidos.ver_solicitud', compact('pedido'));
        }
        Alert::error('No se ha encontrado la solicitud', 'Error en Solicitud');
        return redirect()->back();
    }

    public function ver_iniciado(Pedido $pedido)
    {
        if ($pedido->estado->nombre == 'Iniciado') {
            return view('admin_panel.pedidos.ver_iniciado', compact('pedido'));
        }
        Alert::error('No se ha encontrado el pedido solicitado', 'Error en Pedido Iniciado');
        return redirect()->back();
    }
    public function ver_pendiente(Pedido $pedido)
    {
        if ($pedido->estado->nombre == 'Pendiente') {
            return view('admin_panel.pedidos.ver_pendiente', compact('pedido'));
        }
        Alert::error('No se ha encontrado el Pedido', 'Error en Faltante de Documentacion');
        return redirect()->back();
    }
    public function ver_pago_pendiente(Pedido $pedido)
    {
        if ($pedido->usuario == auth()->user()) {
            if ($pedido->estado->nombre == 'Pago Pendiente') {
                \MercadoPago\SDK::setAccessToken('APP_USR-6383013220139122-101719-44919d629df14faf10fd98f59182400f-185315944');
                $preference = \MercadoPago\Preference::find_by_id($pedido->preference_id);
                $filters = array(
                    "preference" => $pedido->preference_id
                );

                // $payment = \MercadoPago\Payment::find_by_id(22412143);
                // dd($preference);
                return view('admin_panel.pedidos.ver_pago_pendiente', compact('pedido', 'preference'));
            }
        }
        Alert::error('No se ha encontrado el Pedido', 'Error en Pago Pendiente');
        return redirect()->back()->withErrors('Pedido no encontrado.');
    }

    public function ver_revision(Pedido $pedido)
    {
        if ($pedido->estado->nombre == 'Revision') {
            return view('admin_panel.pedidos.ver_revision', compact('pedido'));
        }
        Alert::error('No se ha encontrado dicha Revision', 'Error en Revision');
        return redirect()->back();
    }
    public function procesar_revision(Request $request)
    {
        if ($request->calificacion != null) {
            $pedido = Pedido::find($request->pedido);
            if($pedido->calificacion!=null){
                Alert::error('Este pedido ya se encuentra verificado', 'Error en Valoracion')->persistent();
                return redirect()->route('pedidos.index');
            }
            $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
            $pedido->save();
            $reputacion = Reputacion::create();
            $reputacion->pedido_id = $pedido->id;
            $reputacion->calificacion_id = Calificacion::find($request->calificacion)->id;
            $reputacion->save();
            $historial = Historial::create();
            $historial->user_id = auth()->user()->id;
            $historial->pedido_id = $pedido->id;
            $historial->estado_id = $pedido->estado_id;
            $historial->save();
            return redirect()->route('pedidos.index')->with('success', 'Pedido Guardado');
        } else {
            Alert::error('Por favor seleccione una valoracion para el usuario', 'Error en Valoracion')->persistent();
            return redirect()->back();
        }
    }

    public function procesar_pago($id, Request $request)
    {
        \MercadoPago\SDK::setAccessToken('TEST-6383013220139122-101719-df7b89f30973eab560bd383cd9ddbfd2-185315944');
        if ($request != null) {
            $pedido = Pedido::find($id);
            if ($pedido->estado->nombre == 'Pago Pendiente') {
                if ($request->collection_status == 'approved' && $request->external_reference == $id && $request->preference_id == $pedido->preference_id) {
                    $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
                    $pedido->pago_id = $request->collection_id;
                    $pedido->save();
                    $historial = Historial::create();
                    $historial->user_id = auth()->user()->id;
                    $historial->pedido_id = $pedido->id;
                    $historial->estado_id = $pedido->estado_id;
                    $historial->save();
                } else {
                    return redirect()->route('auto_gestion')->withErrors('Error al Asignar Pago');
                }
            } else {
                return redirect()->route('auto_gestion')->withErrors('Error, Su pago ya se Encuentra Realizado');
            }
        } else {
            return redirect()->route('auto_gestion')->withErrors('Error al Asignar Pago');
        }
        return redirect()->route('pedidos.mis_pedidos')->with('success', 'Su pago ha sido Efectuado Correctamente, Gracias.');
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
        if (auth()->user()->getPenalizacion() <= 0) {
            $tipoItems = TipoItem::all()->where('categoria_id', 1);
            return view('admin_panel.pedidos.nuevo_pedido', compact('tipoItems'));
        } else {
            return redirect()->route('mi_perfil');
        }
    }

    public function consultar_disponibilidad(Request $request)
    {
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
            $fechaInicial = Carbon::createFromFormat('d/m/Y H:i A', $request->inicial . ' ' . $request->hora_inicial);
            $fechaFinal = Carbon::createFromFormat('d/m/Y H:i A', $request->final . ' ' . $request->hora_final);
            $items = $tipoItem->items;
            //Reserva minima de 1 hora complejos y salones
            if ($fechaInicial->diffInMinutes($fechaFinal) < 60) {
                Alert::error('El tiempo minimo para realizar una reserva es de 1 hora.', 'Error en Fechas')->persistent();
                return redirect()->back()->withInput();
            }
        }
        if ($fechaFinal->lessThan($fechaInicial)) {
            Alert::error('Las Fecha de Salida no puede ser menor a la Fecha de Llegada', 'Error en Fechas')->persistent();
            return redirect()->back()->withInput();
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
            $items = TipoItem::find($request->tipoItem)->items;
            // return $items;
            $disponible = true;
            $capacidadNecesaria = $request->capacidad;
            $capacidadActual = 0;
            $itemsRecomendados = collect();
            foreach ($items as $key => $item) {
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
                }
                if ($capacidadActual >= $capacidadNecesaria) {
                    $disponible = false;
                } else {
                    $disponible = true;
                }
                if ($disponible == true) {
                    $itemsRecomendados->push($item);
                    $capacidadActual += $item->capacidad;
                }
                $disponible = true;
            }
            // return $itemsRecomendados;
            if (sizeof($itemsRecomendados) > 0) {
                return view('admin_panel.pedidos.recomendacion', compact('itemsRecomendados', 'fechaInicial', 'fechaFinal', 'tipoItem', 'capacidadNecesaria'));
                // return $itemsRecomendados->pluck('nombre', 'id') . '' . $capacidadActual . ' ' . $capacidadNecesaria;
            } else {
                Alert::error('No hay disponibilidad', 'En esta fecha no se encontro el item solicitado');
                return redirect()->back()->withInput();
            }
        }
        $items->pluck('nombre', 'id');
        return view('admin_panel.pedidos.asignacion', compact('items', 'fechaInicial', 'fechaFinal', 'tipoItem'));
    }



    function detalle_pedido(Request $request)
    {
        // return $request;
        $fechaInicial = $request->fechaInicial;
        $fechaFinal = $request->fechaFinal;
        $tipoItem = null;
        $item = null;
        $items = collect();
        $precioTotal = null;
        if (is_array($request->item_id)) {
            foreach ($request->item_id as $item) {
                $item = Item::find($item);
                $items->push($item);
            }
            if ($item->tipoItem->calculo == false) {
                $diferencia = Carbon::create($fechaInicial)->diffInDays(Carbon::create($fechaFinal)) + 1;
            } else {
                $diferencia = Carbon::create($fechaInicial)->diffInHours(Carbon::create($fechaFinal));
            }
            $tipoItem = $item->tipoItem;
            $item = null;
            foreach ($items as $item) {
                $precioTotal += $item->precioUnitario;
            }
            // return 'muchos items';
            return view('admin_panel.pedidos.detalle_pedido', compact('items', 'precioTotal', 'item', 'tipoItem', 'fechaInicial', 'fechaFinal', 'diferencia'));
        } else {
            $item = Item::find($request->item_id);
            if ($item->tipoItem->calculo == false) {
                $diferencia = Carbon::create($fechaInicial)->diffInDays(Carbon::create($fechaFinal)) + 1;
            } else {
                $diferencia = Carbon::create($fechaInicial)->diffInHours(Carbon::create($fechaFinal));
            }
            // return 'un item';
            $tipoItem = $item->tipoItem;
            return view('admin_panel.pedidos.detalle_pedido', compact('item', 'precioTotal', 'items', 'tipoItem', 'fechaInicial', 'fechaFinal', 'diferencia'));
        }


        // return $fechaInicial . $fechaFinal;
        return view('admin_panel.pedidos.detalle_pedido', compact('item', 'fechaInicial', 'fechaFinal', 'diferencia'));
    }

    function disponibilidad_secundarios(Request $request)
    {
        if ($request->item_id == null) {
            Alert::error('Error al Asignar', 'Ingrese un Item Secundario')->persistent();
            return redirect()->back();
        } elseif ($request->cantidad < 0 || $request->cantidad == null) {
            Alert::error('Error al Asignar', 'Seleccione una cantidad del Item Secundario')->persistent();
            return redirect()->back();
        }
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
        // return $request->fechaInicial;
        foreach (auth()->user()->pedidos as $pedido) {
            if ($pedido->estado->nombre == 'Carrito') {
                foreach ($pedido->seguimientos as $seguimiento) {
                    if (($request->item_id == $seguimiento->item->id || $request->items_id[0] == $seguimiento->item->id) && $request->fechaInicial == $seguimiento->fechaInicial && $request->fechaFinal == $seguimiento->fechaFinal) {
                        return redirect()->route('pedidos.listar_carrito')->withErrors('El item solicitado ya se encuentra agregado');
                    }
                }
                //ARMADO DE SEGUIMIENTOS POR PAQUETE DE ITEMS
                if ($request->items_id != null) {
                    $items = collect();
                    foreach ($request->items_id as $i) {
                        $item1 = Item::find($i);
                        $items->push($item1);
                    }
                    foreach ($items as $item) {
                        $seguimiento = new Seguimiento();
                        $seguimiento->pedido_id = $pedido->id;
                        $seguimiento->fechaInicial = $request->fechaInicial;
                        $seguimiento->fechaFinal = $request->fechaFinal;
                        $seguimiento->item_id = $item->id;
                        $seguimiento->precio = $item->precioUnitario;
                        $seguimiento->save();
                    }
                    return redirect()->route('pedidos.listar_carrito');
                    //ARMADO NORMAL DE UN SEGUIMIENTO
                } else {
                    $seguimiento = new Seguimiento();
                    $seguimiento->pedido_id = $pedido->id;
                    $seguimiento->fechaInicial = $request->fechaInicial;
                    $seguimiento->fechaFinal = $request->fechaFinal;
                    $seguimiento->item_id = $request->item_id;
                    $item = Item::find($request->item_id);
                    $seguimiento->precio = $item->precioUnitario;
                    $seguimiento->save();
                    return redirect()->route('pedidos.listar_carrito');
                }
            }
        }

        $pedido = new Pedido();
        $pedido->user_id = auth()->user()->id;
        $workflow = FlujoTrabajo::where('nombre', 'Pedidos')->firstOrFail();
        $pedido->flujoTrabajo_id = $workflow->id;
        $pedido->estado_id = $workflow->estado_inicial()->id;
        $pedido->save();
        if ($request->items_id != null) {
            $items = collect();
            foreach ($request->items_id as $i) {
                $item1 = Item::find($i);
                $items->push($item1);
            }
            foreach ($items as $item) {
                // return 'entre';
                $seguimiento = new Seguimiento();
                $seguimiento->pedido_id = $pedido->id;
                $seguimiento->fechaInicial = $request->fechaInicial;
                $seguimiento->fechaFinal = $request->fechaFinal;
                $seguimiento->item_id = $item->id;
                $seguimiento->precio = $item->precioUnitario;
                $seguimiento->save();
            }
            return redirect()->route('pedidos.listar_carrito');
        } else {
            $seguimiento = new Seguimiento();
            $seguimiento->pedido_id = $pedido->id;
            $seguimiento->fechaInicial = $request->fechaInicial;
            $seguimiento->fechaFinal = $request->fechaFinal;
            $seguimiento->item_id = $request->item_id;
            $item = Item::find($request->item_id);
            $seguimiento->precio = $item->precioUnitario;
            $seguimiento->save();
        }

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

        // return redirect()->back();
        $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
        $pedido->save();
        $historial = new Historial();
        $historial->user_id = auth()->user()->id;
        $historial->estado_id = $pedido->estado_id;
        $historial->pedido_id = $pedido->id;
        $historial->save();
        event(new PedidoPendiente('Nuevo Pedido Pendiente!'));
        return redirect()->route('pedidos.pendientes');
    }

    function generar_pedido(Request $request)
    {
        if ($request->hasFile('file')) {
            $pedido = Pedido::find($request->pedido);
            $archivo = $request->file('file');
            $nombre = time() . '-' . $pedido->usuario->name . '.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('/documentacion/pedidos'), $nombre);
            $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
            $pedido->documentacion = $nombre;
            $pedido->save();
            $historial = new Historial();
            $historial->user_id = auth()->user()->id;
            $historial->estado_id = $pedido->estado_id;
            $historial->pedido_id = $pedido->id;
            $historial->save();
            event(new PedidoSolicitado('Nuevo Pedido Solicitado'));
            return redirect()->route('pedidos.mis_pedidos');
        } else {
            return redirect()->back()->withErrors('Seleccione un Archivo antes de Enviar su Pedido');
        }
    }

    public function generar_documentacion(Pedido $pedido)
    {
        Date::setLocale('es');
        $fecha= Date::now()->format('l d F Y');
        // return $fecha;
        $nombre = 'Solicitud-Pedido-'.$pedido->id.Carbon::now().'.pdf';
        $pdf = PDF::loadView('admin_panel.pdf.documentacion', compact('pedido', 'fecha'));
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $y = $canvas->get_height() - 35;
        $pdf->getDomPDF()->get_canvas()->page_text(500, $y, "Pagina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download($nombre);
        // return $pdf->stream();
    }

    function asignar_estado(Request $request)
    {
        if ($request->estado == null) {
            return redirect()->back()->withErrors('Asigne un Estado antes de Enviar');
        }
        $pedido = Pedido::find($request->pedido);
        if (Estado::find($request->estado)->nombre == 'Pago Pendiente') {
            $nombre = null;
            foreach ($pedido->seguimientos as $seguimiento) {
                $nombre .= $seguimiento->item->nombre . ' ';
            }
            \MercadoPago\SDK::setAccessToken('APP_USR-6383013220139122-101719-44919d629df14faf10fd98f59182400f-185315944');
            $preference = new \MercadoPago\Preference();
            $item = new \MercadoPago\Item();
            $item->title = $nombre;
            $item->description = $nombre;
            $item->quantity = 1;
            $item->unit_price = $pedido->getPrecioTotal();
            $preference->back_urls = array(
                "success" => route('pedidos.procesar_pago', $pedido->id),
                "failure" => "skere/failure",
                "pending" => "skere/pending"
            );
            $preference->auto_return = "approved";
            $preference->external_reference = $pedido->id;
            $preference->items = array($item);
            $preference->save();
            $pedido->preference_id = $preference->id;
        }

        $historial = Historial::create();
        $historial->user_id = auth()->user()->id;
        $historial->estado_id = $request->estado;
        $historial->pedido_id = $pedido->id;
        $historial->save();
        $pedido->estado_id = $request->estado;
        $pedido->save();
        return redirect()->route('pedidos.solicitudes')->with('success', 'Pedido Guardado');
    }
    function asignar_estado_seguimiento(Request $request)
    {
        $seguimiento = Seguimiento::find($request->seguimiento);
        $historial = HistorialSeguimiento::create();
        if ($request->revision != null) {
            $historial->revision = $request->revision;
        }
        $historial->estado_id = $request->estado;
        $historial->seguimiento_id = $seguimiento->id;
        $historial->item_id = $seguimiento->item->id;
        $historial->save();
        $seguimiento->estado_id = $request->estado;
        $seguimiento->save();
        return redirect()->back()->withInput();
    }

    public function asignar_estado_general(Request $request)
    {
        $seguimiento = Seguimiento::find($request->seguimiento);
        $historial = HistorialSeguimiento::create();
        if ($request->revision != null) {
            $historial->revision = $request->revision;
        }
        $historial->estado_id = $request->estado;
        $historial->seguimiento_id = $seguimiento->id;
        $historial->item_id = $seguimiento->item->id;

        $seguimiento->estado_id = $request->estado;

        $adicionales = collect();
        if ($request->adicionales != null) {
            foreach ($request->adicionales as $id) {
                $adicionales->push(Adicional::find($id));
            }
            foreach ($adicionales as $id => $adicional) {
                $adicional->estado_id = $adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->id;
                $hist = HistorialAdicional::create();
                $hist->adicional_id = $adicional->id;
                if ($request->revision_adicional[$id] != null) {
                    $hist->revision = $request->revision_adicional[$id];
                }
                if ($request->faltantes[$id] != null) {
                    $faltante = $request->faltantes[$id];
                    // return $faltante;
                    $item = $adicional->item;
                    if ($faltante > 0 && $faltante <= $item->cantidad) {
                        $item->cantidad -= $request->faltantes[$id];
                        $hist->faltante = $request->faltantes[$id];
                        // return $item->cantidad;
                        $item->save();
                    } else {
                        Alert::error('Error', 'El valor ingresado para el faltante es incorrecto')->persistent();
                        return redirect()->back();
                    }
                }
                $hist->estado_id = $adicional->item->tipoItem->flujoTrabajo->estado_siguiente($adicional->estado)->id;
                $hist->item_id = $adicional->item->id;
                $adicional->save();
                $hist->save();
            }
        }
        $historial->save();
        $seguimiento->save();
        return redirect()->back();
    }

    public function generar_documentacion_historial(HistorialSeguimiento $historial)
    {
        $fecha= Date::now()->format('l d F Y');
        $seguimiento = $historial->seguimiento;
        if ($historial->estado->nombre == 'Entregado') {
            $pdf = PDF::loadView('admin_panel.pdf.entrega', compact('seguimiento', 'fecha'));
        } elseif ($historial->estado->nombre == 'Terminado') {
            $pdf = PDF::loadView('admin_panel.pdf.devolucion', compact('seguimiento', 'fecha'));
        }
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $y = $canvas->get_height() - 35;
        $pdf->getDomPDF()->get_canvas()->page_text(500, $y, "Pagina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->download('comprobante_' . $seguimiento->item->nombre . '_' . $seguimiento->estado->nombre . '.pdf');
        // return $pdf->stream();
    }

    public function asignar_documentacion_historial(Request $request, HistorialSeguimiento $historial)
    {
        if ($historial->documentacion == null) {
            $documento = $request->file('documento');
            if ($historial->estado->nombre == 'Entregado') {
                $nomDoc = 'Entrega ' . $historial->item->nombre . '.' . $documento->getClientOriginalExtension();
                $documento->move(public_path('/documentacion/historiales/' . $historial->id), $nomDoc);
                $historial->documentacion = '/documentacion/historiales/' . $historial->id . '/' . $nomDoc;
                $historial->save();
            } elseif ($historial->estado->nombre == 'Terminado') {
                $nomDoc = 'Devolucion ' . $historial->item->nombre . '.' . $documento->getClientOriginalExtension();
                $documento->move(public_path('/documentacion/historiales/' . $historial->id), $nomDoc);
                $historial->documentacion = '/documentacion/historiales/' . $historial->id . '/' . $nomDoc;
                $historial->save();
            }
            Alert::success('Se ha asignado la documentacion correctamente', 'Historial Guardado');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('La documentacion ya se encuentra asignada');
        }
    }

    function asignar_estado_adicional(Request $request)
    {
        $adicional = Adicional::find($request->adicional);
        $historial = HistorialAdicional::create();
        if ($request->revision != null) {
            $historial->revision = $request->revision;
        }
        if ($request->faltante > 0) {
            $historial->faltante = $request->faltante;
        }
        $historial->estado_id = $request->estado;
        $historial->adicional_id = $adicional->id;
        $historial->item_id = $adicional->item->id;
        $historial->save();
        $adicional->estado_id = $request->estado;
        $adicional->save();
        return redirect()->back()->withInput();
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
        return view('admin_panel.pedidos.seguimiento', compact('historiales', 'pedido'));
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
        $this->validar_finalizacion();

        // return redirect()->back();

        $pedido = Pedido::find($request->pedido_id);
        // return $pedido;
        $historial = Historial::create();
        $pedido->estado_id = $pedido->flujoTrabajo->estado_final()->id;
        $pedido->aviso = $request->aviso;
        $historial->user_id = auth()->user()->id;
        $historial->pedido_id = $pedido->id;
        $historial->estado_id = $pedido->estado_id;
        $historial->save();
        $pedido->save();
        Alert::success('Se han finalizado el pedido correctamente', 'Pedido Guardado ');
        return redirect()->route('pedidos.solicitudes');
    }

    public function pendientes()
    {
        $estado = Estado::where('nombre', 'Pendiente')->firstOrFail();
        $pedidos = auth()->user()->pedidos->where('estado_id', $estado->id)->sortBy('FechaInicial');
        return view('admin_panel.pedidos.pendientes', compact('pedidos'));
    }
    public function iniciados()
    {
        $estado = Estado::where('nombre', 'Iniciado')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id)->sortBy('FechaInicial');
        return view('admin_panel.pedidos.iniciados', compact('pedidos'));
    }

    public function revision()
    {
        $estado = Estado::where('nombre', 'Revision')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id)->sortBy('FechaInicial');
        return view('admin_panel.pedidos.revision', compact('pedidos'));
    }

    public function pago_pendiente()
    {
        $estado = Estado::where('nombre', 'Pago Pendiente')->firstOrFail();
        $pedidos = auth()->user()->pedidos->where('estado_id', $estado->id)->sortBy('FechaInicial');
        return view('admin_panel.pedidos.pago_pendiente', compact('pedidos'));
    }

    public function actualizar_perfil(Request $request)
    {
        $user = auth()->user();
        $pedidos = auth()->user()->pedidos;

        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->dni = $request->dni;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'Cuenta Actualizada');
    }

    public function mi_perfil()
    {
        $reputacion = auth()->user()->getCalificacion();
        $user = auth()->user();
        // return auth()->user()->getPenalizacion();
        return view('admin_panel.usuarios.perfil', compact('user', 'reputacion'));
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

    public function cantidad_revision()
    {
        $estado = Estado::where('nombre', 'Revision')->firstOrFail();
        return sizeof(Pedido::all()->where('estado_id', $estado->id));
    }

    public function cantidad_pendientes()
    {
        $estado = Estado::where('nombre', 'Pendiente')->firstOrFail();
        return sizeof(auth()->user()->pedidos->where('estado_id', $estado->id));
    }

    public function cantidad_carrito()
    {
        foreach (auth()->user()->pedidos as $pedido) {
            if ($pedido->estado->nombre == 'Carrito') {
                return sizeof($pedido->seguimientos);
            }
        }
        return 0;
    }
    public function cantidad_pagopendiente()
    {
        $estado = Estado::where('nombre', 'Pago Pendiente')->firstOrFail();
        return sizeof(auth()->user()->pedidos->where('estado_id', $estado->id));
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

    public function validar_finalizacion()
    {
        return request()->validate([
            'aviso' => 'required'
        ]);
    }
}
