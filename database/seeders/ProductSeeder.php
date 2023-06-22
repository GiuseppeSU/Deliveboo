<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvContent = Helpers::getCsvContent(__DIR__ . '/products.csv');

        foreach ($csvContent as $index => $row) {
            if ($index > 0) {
                $product = new Product();
                $product->restaurant_id = $row[0];
                $product->name = $row[1];
                $product->price = $row[2];
                $product->description = $row[3];
                $product->image = $row[4];
                $product->slug = Helpers::generateSlug("$product->name $product->restaurant_id");
                $product->save();

            }
        }
    }
}
