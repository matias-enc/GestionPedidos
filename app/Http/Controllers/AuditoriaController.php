<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all()->sortBy('updated_at');
        $usuarios = User::all();
        $auditorias = collect();
        foreach ($pedidos as $pedido) {
            if (!$pedido->audits->isEmpty()) {
                foreach ($pedido->audits as $a) {
                    $auditorias->add($a);
                }
            }
        }
        return view('admin_panel.auditorias.index', compact('auditorias', 'usuarios'));
    }

    public function show($auditoria, $id)
    {
        $pedido = Pedido::find($id);
        $auditoria = $pedido->audits()->find($auditoria);
        // return $auditoria->getModified();
        return view('admin_panel.auditorias.show', compact('auditoria'));
    }

    public function reporte(Request $request)
    {
        $pedidos = Pedido::all()->sortBy('created_at');
        $auditorias = collect();
        // return $request;
        foreach ($pedidos as $pedido) {
            if (!$pedido->audits->isEmpty()) {
                foreach ($pedido->audits as $a) {
                    $auditorias->add($a);
                }
            }
        }
        // return $request;
        $usuario = null;
        $operacion = null;
        $llegada = null;
        $salida = null;
        if ($request->usuario_id != null) {
            $usuario = User::find($request->usuario_id);
            foreach ($auditorias as $id => $auditoria) {
                if ($auditoria->user->id != $request->usuario_id) {
                    $auditorias->pull($id);
                }
            }
        }
        if($request->operacion!=null){
            $operacion = $request->operacion;
            foreach ($auditorias as $id => $auditoria) {
                if($operacion!=$auditoria->event){
                    $auditorias->pull($id);
                }
            }
        }
        if ($request->llegada != null) {
            $llegada = Carbon::createFromFormat('d/m/Y', $request->llegada);
            $llegada->setTime(0, 0, 0);
            $salida = Carbon::createFromFormat('d/m/Y', $request->salida);
            $salida->setTime(0, 0, 0);
            foreach ($auditorias as $id => $auditoria) {
                $fechaAuditoria = $auditoria->created_at;
                $fechaAuditoria->setTime(0,0,0);
                if ($fechaAuditoria->greaterThanOrEqualTo($llegada) && $fechaAuditoria->lessThanOrEqualTo($salida)) {}else{
                    $auditorias->pull($id);
                }
            }
            $llegada = $llegada->format('d/m/Y');
            $salida = $salida->format('d/m/Y');
        }
        $auditorias->sortByDesc('created_at');
        $pdf = PDF::loadView('admin_panel.pdf.auditorias', compact('auditorias', 'operacion', 'usuario', 'llegada', 'salida'));
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $y = $canvas->get_height() - 35;
        $pdf->getDomPDF()->get_canvas()->page_text(500, $y, "Pagina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }
}
