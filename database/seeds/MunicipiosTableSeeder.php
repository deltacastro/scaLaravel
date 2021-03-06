<?php

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
            Municipio::firstOrCreate($value);
        }
    }
}