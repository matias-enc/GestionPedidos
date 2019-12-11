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
            PermisoTableSeeder::class,
            RolTableSeeder::class,
            EstadosTableSeeder::class,
            FlujoTrabajosTableSeeder::class,
            CategoriasTableSeeder::class,
            TipoItemsTableSeeder::class,
            ItemsTableSeeder::class,
            TransicionesTableSeeder::class,
            CalificacionesTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
