<?php

use App\Transicion;
use Illuminate\Database\Seeder;

class TransicionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transicion::create([
            'nombre' => 'Finalizacion'
        ]);
    }
}
