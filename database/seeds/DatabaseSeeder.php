<?php

use App\TipoItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            RolTableSeeder::class,
            PermisoTableSeeder::class,
            EstadosTableSeeder::class,
            FlujoTrabajosTableSeeder::class,
            CategoriasTableSeeder::class,
            TipoItemsTableSeeder::class,
            ItemsTableSeeder::class,
            PedidosTableSeeder::class,
            TransicionesTableSeeder::class,
            CalificacionesTableSeeder::class
            ]);

    }
}
