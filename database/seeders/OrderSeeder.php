<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use function PHPSTORM_META\map;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants_count = Restaurant::select('id')->count();

        for ($i = 1; $i <= $restaurants_count; $i++) {
            $products_collection = Product::where('restaurant_id', $i)->get('id');
            $products_array = [];
            foreach ($products_collection as $product) {
                $products_array[] = $product->id;
            }
            for ($n = 0; $n < 20; $n++) {
                $newOrder = new Order;
                $newOrder->order_code = $faker->regexify('[A-Z0-9]{32}');
                $newOrder->name = $faker->name();
                $newOrder->email = $faker->email();
                $newOrder->address = $faker->address();
                $newOrder->total = 2;
                $newOrder->phone_number = $faker->numerify('3#########');
                $newOrder->status = 'done';
                $newOrder->save();
                $newOrder->created_at = $faker->dateTimeBetween('-1 year', 'now', 'Europe/Rome');
                $newOrder->update();

                //scelgo un numero casuale di prodotti per l'ordine
                $cart_number = $faker->numberBetween(1, count($products_array));
                //prendo a caso quel numero di prodotti tra quelli venduti dal ristorante
                $products_in_cart = $faker->randomElements($products_array, $cart_number);
                //scelgo una quantità casuale di pezzi per ogni prodotto
                foreach ($products_in_cart as $product) {
                    $newOrder->products()->attach($product, ['quantity' => $faker->numberBetween(1, 5)]);
                }
                //aggiorno il totale
                $order_total = 0;
                foreach ($newOrder->products as $product) {
                    $order_total += ($product->price * $product->pivot->quantity);
                }
                $newOrder->total = $order_total;
                $newOrder->update();
            }
        }
    }
}
