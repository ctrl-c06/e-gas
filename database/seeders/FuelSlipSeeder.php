<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\FuelSlip;
use Illuminate\Database\Seeder;

class FuelSlipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 10) as $range) {
            FuelSlip::create([
                'issued_date'      => Carbon::now(),
                'gasoline_station' => 'Tandag Petron Gasoline Station',
                'no_of_liters'     => $range,
            ]);
        }
    }
}
