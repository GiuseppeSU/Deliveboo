<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i=0; $i<100; $i++){
            $newOrder = new Order;
            $newOrder->order_code = $faker->regexify('[A-Z0-9]{32}');
            $newOrder->name = $faker->name();
            $newOrder->email = $faker->email();
            $newOrder->address = $faker->address();
            $newOrder->total = $faker->randomFloat(2, 1, 999);
            $newOrder->phone_number = $faker->numerify('3#########');
            $newOrder->status = 'done';
            $newOrder->save();
            $months = $faker->randomElement(['01','02','03','04','05','06','07','08','09','10','11','12']);
            $newOrder->created_at = $faker->dateTimeBetween('-1 year', 'now', 'Europe/Rome');
            $newOrder->update();

            $csvContent = Helpers::getCsvContent(__DIR__ . '/order_product.csv');
            foreach ($csvContent as $index => $row) {
                if ($index > 0) {
                    if($row[0] == $newOrder->id ){
                        $newOrder->products()->attach($row[1],['quantity' => $row[2]]);
                    }
                }
            }
        }
    }
}
