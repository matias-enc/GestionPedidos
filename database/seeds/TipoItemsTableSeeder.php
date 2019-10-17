<?php

use App\TipoItem;
use Illuminate\Database\Seeder;

class TipoItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoItem::create([
            'nombre' => 'Salones de Eventos',
            'flujoTrabajo_id' => '4',
            'categoria_id' => '1',
            'descripcion' => '',
            'adicional' => true,
            'calculo' => true,
        ]);
        TipoItem::create([
            'nombre' => 'Complejos',
            'flujoTrabajo_id' => '3',
            'categoria_id' => '1',
            'descripcion' => '',
            'adicional' => true,
            'calculo' => true,
        ]);
        TipoItem::create([
            'nombre' => 'Albergues',
            'flujoTrabajo_id' => '2',
            'categoria_id' => '1',
            'descripcion' => '',
            'adicional' => false,
            'calculo' => false,
        ]);
        TipoItem::create([
            'nombre' => 'Secundarios',
            'flujoTrabajo_id' => '5',
            'categoria_id' => '2',
            'descripcion' => '',
            'adicional' => false,
            'calculo' => false,
        ]);
    }
}
