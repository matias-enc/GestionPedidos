<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\User;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
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
}
