<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvContent = Helpers::getCsvContent(__DIR__ . '/users.csv');

        foreach ($csvContent as $index => $row) {
            if ($index > 0) {
                $user = new User();
                $user->name = $row[0];
                $user->email = $row[1];
                $user->password = $row[2];
                $user->save();

            }
        }
    }
}
