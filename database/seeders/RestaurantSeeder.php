<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helpers;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvContent = Helpers::getCsvContent(__DIR__ . '/restaurants.csv');

        foreach ($csvContent as $index => $row) {
            if ($index > 0) {
                $restaurant = new Restaurant();
                $restaurant->user_id = $row[0];
                $restaurant->name = $row[1];
                $restaurant->address = $row[2];
                $restaurant->vat = $row[3];
                $restaurant->image = $row[4];
                $restaurant->slug = Helpers::generateSlug($restaurant->name);
                $restaurant->save();
                $restaurant->types()->attach(explode('-',$row[5]));
                $restaurant->update();
            }
        }



    }
}