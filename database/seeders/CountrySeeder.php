<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
  
        $countries = [
            ['name' => 'Afghanistan'],
            ['name' => 'Åland Islands'],
            ['name' => 'Albania'],
            ['name' => 'Algeria'],
            ['name' => 'American Samoa'],
            ['name' => 'Andorra'],
            ['name' => 'Egypt']
        ];
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
