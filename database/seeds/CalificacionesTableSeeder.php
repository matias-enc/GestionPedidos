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
            'nombre' => 'Muy Mala',
            'penalizacion' => '250',
            'color' => 'bg-danger'
        ]);
        Calificacion::create([
            'nombre' => 'Mala',
            'penalizacion' => '90',
            'color' => 'bg-warning'
        ]);
        Calificacion::create([
            'nombre' => 'Regular',
            'color' => 'bg-danger'
        ]);
        Calificacion::create([
            'nombre' => 'Buena',
            'color' => 'bg-danger'
        ]);
        Calificacion::create([
            'nombre' => 'Muy Buena',
            'color' => 'bg-danger'
        ]);

    }
}
