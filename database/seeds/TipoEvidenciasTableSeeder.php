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
            ['nombre' => 'calendario'],
            ['nombre' => 'entrada y salida'],
            ['nombre' => 'gps']
        ];

        foreach ($datas as $key => $value) {
            TipoEvidencia::firstOrCreate($value);
        }
    }
}
