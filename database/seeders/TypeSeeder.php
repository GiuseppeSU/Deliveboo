<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvContent = Helpers::getCsvContent(__DIR__ . '/types.csv');

        foreach ($csvContent as $index => $row) {
            if ($index > 0) {
                $type = new Type();
                $type->name = $row[0];
                $type->image = $row[1];
                $type->icon = $row[2];
                $type->slug = Helpers::generateSlug($type->name);
                $type->save();

            }
        }
    }
}