<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{

    public function run(): void
    {
        
        $csvFile = fopen(storage_path('files\countries.csv'), 'r');

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Country::create([
                    "name" => $data['0'],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);

    }
}
