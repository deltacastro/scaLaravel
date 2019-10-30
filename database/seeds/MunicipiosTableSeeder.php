<?php

use App\Estado;
use Illuminate\Database\Seeder;
use App\Municipio;
class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            'Tabasco' => [
                ['nombre' => 'Balancán'],
                ['nombre' => 'Cárdenas'],
                ['nombre' => 'Centla'],
                ['nombre' => 'Centro'],
                ['nombre' => 'Comalcalco'],
                ['nombre' => 'Cunduacán'],
                ['nombre' => 'Emiliano Zapata'],
                ['nombre' => 'Huimanguillo'],
                ['nombre' => 'Jalapa'],
                ['nombre' => 'Jalpa de Méndez'],
                ['nombre' => 'Jonuta'],
                ['nombre' => 'Macuspana'],
                ['nombre' => 'Nacajuca'],
                ['nombre' => 'Paraíso'],
                ['nombre' => 'Tacotalpa'],
                ['nombre' => 'Teapa'],
                ['nombre' => 'Tenosique']
            ],
            'Durango' => [
                ['nombre' => 'Victoria de Durango'],
            ]
        ];

        foreach ($estados as $estado => $municipios) {
            $estado = Estado::firstorcreate(['nombre' => $estado]);
            foreach ($municipios as $municipio) {
                Municipio::updateorcreate($municipio, ['estado_id'=> $estado->id]);
            }
        }
    }
}