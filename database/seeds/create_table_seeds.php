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
        DB::table('users')->insert([
            'fname' => "Ebrahim",
            'sname' => "Ravat",
            'phone' => "",
            'email' => "eby_146@hotmail.co.uk",
            'password' => bcrypt('poop123'),
            'admin' => "1"
        ]);

    	$faker = Faker::create();
    	foreach (range(1,20) as $index) {
            $name = $faker->firstName();
	        DB::table('users')->insert([
	            'fname' => $name,
                'sname' => $faker->lastname(),
                'phone' => "07".$faker->numberBetween(100000000, 999999999),
	            'email' => $name."@".$faker->domainName,
	            'password' => bcrypt('poop123'),
                'admin' => "0"
	        ]);
        }

        DB::table('post')->insert([
            'user_id' => "1",
            'title' => "A paragraph from wiki",
            'comment' => "A paragraph (from the Ancient Greek παράγραφος paragraphos, \"to write beside\" or \"written beside\") is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences."
        ]);

        foreach (range(1,20) as $index) {
            DB::table('post')->insert([
                'user_id' => $faker->numberBetween(1,20),
                'title' => $faker->word,
                'comment' => $faker->paragraph
            ]);
        }
    }
}
