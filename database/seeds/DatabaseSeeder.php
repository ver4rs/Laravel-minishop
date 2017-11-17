<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * One file for seeding data without factories files
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create();

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin meno',
            'email' => 'admin@admin.sk',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Apple',
                'description' => $faker->paragraph(3),
                'price' => 23.34,
                'count' => 10,
                'image1' => null,
                'image2' => null,
                'image3' => null,
            ],
            [
                'id' => 2,
                'name' => 'Banana',
                'description' => $faker->paragraph(4),
                'price' => 12.32,
                'count' => 24,
                'image1' => null,
                'image2' => null,
                'image3' => null,
            ],
            [
                'id' => 3,
                'name' => 'Orange',
                'description' => $faker->paragraph(3),
                'price' => 3.25,
                'count' => 8,
                'image1' => null,
                'image2' => null,
                'image3' => null,
            ],
        ]);


    }
}
