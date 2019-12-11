<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->validacion->aprobado==true){
            if(auth()->user()->hasRole('empleado')){
                return redirect()->route('pedidos.estadisticas');
            }
            return view('admin_panel.home');
        }
        return redirect()->route('validacion_datos');
    }
}
