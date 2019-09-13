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
            'nombre' => 'Albergues',
            'flujoTrabajo_id' => '2',
            'descripcion' => '',
        ]);
        TipoItem::create([
            'nombre' => 'Salones de Eventos',
            'flujoTrabajo_id' => '2',
            'descripcion' => '',
        ]);
        TipoItem::create([
            'nombre' => 'Complejos',
            'flujoTrabajo_id' => '2',
            'descripcion' => '',
        ]);
    }
}
