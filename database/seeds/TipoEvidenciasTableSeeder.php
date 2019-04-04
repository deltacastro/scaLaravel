<?php

use Illuminate\Database\Seeder;
use App\TipoEvidencia;

class TipoEvidenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $datas = [
            ['nombre' => 'calendario', 'mostrar' => 'Calendario'],
            ['nombre' => 'entrada y salida', 'mostrar' => 'Entrada y Salida'],
            ['nombre' => 'gps', 'mostrar' => 'GPS']
        ];

        foreach ($datas as $key => $value) {
            TipoEvidencia::firstOrCreate($value);
        }
    }
}
