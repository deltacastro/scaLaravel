<?php

use Illuminate\Database\Seeder;

class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
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
        ];

        foreach ($datas as $key => $value) {
            TipoEvidencia::firstOrCreate($value);
        }
    }
}


Balancán 	 de Domínguez 	010 	Jalpa de Méndez 	Jalpa de Méndez
002 	Cárdenas 	Heroica Cárdenas 	011 	Jonuta 	Jonuta
003 	Centla 	Frontera 	012 	Macuspana 	Macuspana
004 	Centro 	Villahermosa 	013 	Nacajuca 	Nacajuca
005 	Comalcalco 	Comalcalco 	014 	Paraíso 	Paraíso
006 	Cunduacán 	Cunduacán 	015 	Tacotalpa 	Tacotalpa
007 	Emiliano Zapata 	Emiliano Zapata 	016 	Teapa 	Teapa
008 	Huimanguillo 	Huimanguillo 	017 	Tenosique 	Tenosique de Pino Suárez
009 	Jalapa 	Jalapa 		