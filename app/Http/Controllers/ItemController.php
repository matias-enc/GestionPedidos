<?php

namespace App\Http\Controllers;

use App\Item;
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
            if ($item->cantidad==null) {
                $muebles->push($item);
            }elseif($item->capacidad==null){
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
        $tipoItems = TipoItem::all();
         return view('admin_panel.inventario.create', compact('items', 'tipoItems'));
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
         $item->delete();

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
