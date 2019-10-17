<?php

use App\Calificacion;
use Illuminate\Database\Seeder;

class CalificacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calificacion::create([
            'nombre' => 'Muy Mala'
        ]);
        Calificacion::create([
            'nombre' => 'Mala'
        ]);
        Calificacion::create([
            'nombre' => 'Regular'
        ]);
        Calificacion::create([
            'nombre' => 'Buena'
        ]);
        Calificacion::create([
            'nombre' => 'Muy Buena'
        ]);

    }
}
