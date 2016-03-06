<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class create_table_seeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('poop123'),
                'admin' => $faker->numberBetween(0,1)
	        ]);
        }

        foreach (range(1,20) as $index) {
            DB::table('post')->insert([
                'user_id' => $faker->numberBetween(1,20),
                'title' => $faker->word,
                'comment' => $faker->paragraph
            ]);
        }
    }
}
