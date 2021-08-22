<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            [
                'name' => 'Monster Ultra Sunrise',
                'caffeine' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Black Coffee',
                'caffeine' => 95,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Americano',
                'caffeine' => 77,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sugar free NOS',
                'caffeine' => 130,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '5 Hour Energy',
                'caffeine' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
