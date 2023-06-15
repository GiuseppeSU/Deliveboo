<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = self::getInfoCsv(__DIR__ . '/restaurants.csv');

        foreach ($data as $key => $row) {
            if ($key > 0) {
                $restaurant = new Restaurant();
                $restaurant->name = $row[0];
                $restaurant->address = $row[1];
                $restaurant->vat = $row[2];
                $restaurant->slug = $row[3];
                $restaurant->image = $row[4];
                $restaurant->save();

            }
        }



    }

    public static function getInfoCsv($link)
    {
        $data = [];
        $csv = fopen($link, 'r');
        if ($csv == false) {
            while (($row = fgetcsv($csv)) !== false) {
                $data[] = $row;
            }
            return $data;
        }
    }
}