<?php

use App\Estado;
use Illuminate\Database\Seeder;
use App\Municipio;
use App\Sucursal;

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
                'Balancán' => [],
                'Cárdenas' => [],
                'Centla' => [],
                'Centro' => [],
                'Comalcalco' => [],
                'Cunduacán' => [],
                'Emiliano Zapata' => [],
                'Huimanguillo' => [],
                'Jalapa' => [],
                'Jalpa de Méndez' => [],
                'Jonuta' => [],
                'Macuspana' => [],
                'Nacajuca' => [],
                'Paraíso' => [],
                'Tacotalpa' => [],
                'Teapa' => [],
                'Tenosique' => []
            ],
            'Durango' => [
                'Victoria de Durango' => [],
            ],
            'Guanajuato' => [
                'León' => [
                    ['nombre' => 'Sucursal 1'],
                    ['nombre' => 'Sucursal 2']
                ],
                'San Juan del Rio' => []
            ],
            'Queretaro' => [
                'San Luis de la Paz' => []
            ],
            'Michoacan' => [
                'Morelia' => []
            ]
        ];

        foreach ($estados as $estado => $municipios) {
            $estado = Estado::firstorcreate(['nombre' => $estado]);
            foreach ($municipios as $municipio => $sucursales) {
                $municipio = Municipio::updateorcreate(['nombre' => $municipio], ['estado_id'=> $estado->id]);
                foreach ($sucursales as $sucursal) {
                    Sucursal::firstorcreate(['nombre' => $sucursal['nombre'], 'municipio_id' => $municipio->id]);
                }
            }
        }
    }
}