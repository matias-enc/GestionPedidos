<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Inmuebles'
        ]);
        Categoria::create([
            'nombre' => 'Muebles'
        ]);
    }
}
