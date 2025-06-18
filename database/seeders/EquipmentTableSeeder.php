<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::create([

        'name' => 'Экскаватор-погрузчик',
        'description' => 'Shanmon 388H, 2025, Объём фронтального ковша, М3 1.0
        Габариты стандартного ковша Д*Ш*В, мм 2250*993*517.5
        Грузоподъемность, кг 2500
        Высота выгрузки, мм 305
        Габариты, мм 4130*2630*3120
        Угол подъема, ° 25
        Смещение каретки Гидравлическое
        Макс. тяговое усилие, кН 100
        Эксплуатационная масса, кг 8200
        Объем топливного бака, л 130
        Объем заливаемого масла, л 12',
        'status' => 'available',
        'hourly_rate' => 10000
    ]);
        //
    }
}
