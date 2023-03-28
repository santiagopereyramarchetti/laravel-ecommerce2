<?php

namespace Database\Seeders;

use App\Models\Cupons\Cupon;
use App\Models\Cupons\FixedValueCupon;
use App\Models\Cupons\PercentOffCupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $percent = PercentOffCupon::create([
            'percent_off' => 10
        ]);

        $fixed = FixedValueCupon::create([
            'value' => 2000
        ]);

        Cupon::create([
            'code' => 'ABC123',
            'cuponable_id' => $percent->id,
            'cuponable_type' => get_class($percent)
        ]);

        Cupon::create([
            'code' => 'DEF456',
            'cuponable_id' => $fixed->id,
            'cuponable_type' => get_class($fixed)
        ]);
    }
}
