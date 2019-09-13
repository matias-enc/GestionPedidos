<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'nombre' => 'Habitacion 1',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '5',
        ]);
        Item::create([
            'nombre' => 'Habitacion 2',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '5',
        ]);
        Item::create([
            'nombre' => 'Habitacion 3',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '4',
        ]);
        Item::create([
            'nombre' => 'Habitacion 4',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '8',
        ]);
        Item::create([
            'nombre' => 'Habitacion 5',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '8',
        ]);
        Item::create([
            'nombre' => 'Habitacion 6',
            'tipoItems_id' => '1',
            'descripcion' => 'Habitacion de un Alvergue',
            'capacidad' => '4',
        ]);
    }
}
