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
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '5',
            'precioUnitario' => '600',
        ]);
        Item::create([
            'nombre' => 'Habitacion 2',
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '5',
            'precioUnitario' => '600',
        ]);
        Item::create([
            'nombre' => 'Habitacion 3',
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '4',
            'precioUnitario' => '450',
        ]);
        Item::create([
            'nombre' => 'Habitacion 4',
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '8',
            'precioUnitario' => '800',
        ]);
        Item::create([
            'nombre' => 'Habitacion 5',
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '8',
            'precioUnitario' => '800',
        ]);
        Item::create([
            'nombre' => 'Habitacion 6',
            'tipoItems_id' => '3',
            'descripcion' => 'Habitacion de un Albergue',
            'capacidad' => '4',
            'precioUnitario' => '450',
        ]);
        Item::create([
            'nombre' => 'Mesas de Madera',
            'tipoItems_id' => '4',
            'descripcion' => '',
            'cantidad' => '80',
            'precioUnitario' => '20',
        ]);
        Item::create([
            'nombre' => 'Sillas de Plastico',
            'tipoItems_id' => '4',
            'descripcion' => '',
            'cantidad' => '100',
            'precioUnitario' => '40',
        ]);
        Item::create([
            'nombre' => 'Complejo Principal',
            'tipoItems_id' => '2',
            'descripcion' => 'Complejo grande de evento con una capacidad de hasta 1000 personas',
            'capacidad' => '1000',
            'precioUnitario' => '4500',
        ]);
        Item::create([
            'nombre' => 'Salon Vidriado ',
            'tipoItems_id' => '1',
            'descripcion' => 'Salon de eventos con una capacidad para 250 personas',
            'capacidad' => '250',
            'precioUnitario' => '4500',
        ]);
    }
}
