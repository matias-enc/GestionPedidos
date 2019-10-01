<?php

namespace App\Http\Controllers;

use Alert;
use App\Adicional;
use App\Categoria;
use App\Item;
use App\Seguimiento;
use App\TipoItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
         $items = Item::all();

         $muebles = collect();
         $inmuebles = collect();

         foreach ($items as $id => $item) {
            if ($item->tipoItem->categoria->nombre=='Muebles') {
                $muebles->push($item);
            }elseif($item->tipoItem->categoria->nombre=='Inmuebles'){
                $inmuebles->push($item);
            }
         }
         return view('admin_panel.inventario.index', compact('muebles', 'inmuebles'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {

        $categorias = Categoria::all();
         return view('admin_panel.inventario.create', compact('categorias'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $item = Item::create($this->validar());

         return redirect()->route('item.index');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show(Item $item)
     {
         return view('admin_panel.inventario.show', compact('item'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit(Item $item)
     {
         return view('admin_panel.inventario.edit', compact('item'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Item $item)
     {
         $item->update($request->all());

         return redirect()->route('item.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Item $item)
     {
         $seguimientos = Seguimiento::all()->where('item_id', $item->id);
         $adicionales = Adicional::all()->where('item_id', $item->id);
        //  return sizeof($seguimientos);
        if(sizeof($seguimientos)>0 ){
            Alert::warning('Esta siendo referenciado dentro de un pedido', 'El item no puede ser Eliminado');
        }elseif(sizeof($adicionales)>0){
            Alert::warning('Esta siendo referenciado dentro de un pedido', 'El item no puede ser Eliminado');
        }else{
            $item->delete();

        }

         return back();
     }
     public function validar(){
        return request()->validate([
            'nombre' => 'required',
            'tipoItems_id' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'nullable|integer',
            'capacidad' => 'nullable|integer'
        ]);
    }
}
