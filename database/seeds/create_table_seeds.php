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
        //USER --------------------------------------------------------------
        DB::table('users')->insert([
            'fname'            => "Ebrahim",
            'sname'            => "Ravat",
            'phone'            => "",
            'email'            => "eby_146@hotmail.co.uk",
            'password'         => bcrypt('mypass123'),
            'house_no'          => "24",
            'postcode'          => "WF17 7ND",
            'admin'            => "1"
        ]);

    	$faker = Faker::create('en_GB');
        $num_of_users1 = 10;
        $num_of_users2 = 5;
        $num_of_users = $num_of_users1+$num_of_users2+1;

    	foreach (range(1,$num_of_users1) as $index) {
            $name = $faker->firstName();
	        DB::table('users')->insert([
	            'fname'        => $name,
                'sname'        => $faker->lastname(),
                'phone'        => "07".$faker->numberBetween(100000000, 999999999),
	            'email'        => $name."@".$faker->domainName,
	            'password'     => bcrypt('mypass123'),
                'house_no'     => $faker->numberBetween(1,200),
                'postcode'     => $faker->postcode(),
                'admin'        => "0"
	        ]);
        }

        foreach (range(1,$num_of_users2) as $index) {
            $name = $faker->firstName();
            DB::table('users')->insert([
                'fname'        => $name,
                'sname'        => $faker->lastname(),
                'phone'        => "07".$faker->numberBetween(100000000, 999999999),
                'email'        => $name."@".$faker->domainName,
                'password'     => bcrypt('poop123'),
                'house_no'     => "",
                'postcode'     => "",
                'admin'        => "0"
            ]);
        }


        //POST --------------------------------------------------------------
        DB::table('post')->insert([
            'user_id' => "1",
            'post_type' => "1",
            'title' => "A paragraph from wiki",
            'comment' => "A paragraph (from the Ancient Greek παράγραφος paragraphos, \"to write beside\" or \"written beside\") is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.",
            'job_type' => $this->randomJobType()
        ]);
        $num_of_posts1 = 10;
        $num_of_posts2 = 10;
        $num_of_posts = $num_of_posts1+$num_of_posts2+1;
        foreach (range(1,$num_of_posts1) as $index) {
            DB::table('post')->insert([
                'user_id' => $faker->numberBetween(1,$num_of_users),
                'post_type' => $faker->numberBetween(0,1),
                'title' => $faker->word,
                'comment' => $faker->paragraph,
                'job_type' => $this->randomJobType()
            ]);
        }

        foreach (range(1,$num_of_posts2) as $index) {
            DB::table('post')->insert([
                'user_id' => $faker->numberBetween(1,$num_of_users),
                'post_type' => $faker->numberBetween(0,1),
                'title' => $faker->word,
                'comment' => $faker->paragraph,
                'job_type' => $this->randomJobType()
            ]);
        }
        
        //SUBSCRIPTION -----------------------------------------------------------------

        foreach (range(1,$num_of_posts1) as $index) {
            DB::table('subscription')->insert([
                'post_id' => $faker->numberBetween(1,$num_of_posts),
                'user_id' => $faker->numberBetween(1,$num_of_users),
                'rating' => $faker->numberBetween(1,5)
            ]);
        }

        //MESSAGE -----------------------------------------------------------------
        $num_of_messages = 20;
        foreach (range(1,$num_of_messages) as $index) {
            DB::table('message')->insert([
                'msg_user_id' => $faker->numberBetween(0,$num_of_users1+$num_of_users2),
                'post_id' => $faker->numberBetween(1,$num_of_posts),
                'subject' => $faker->word,
                'msg' => $faker->paragraph,
            ]);
        }

    }

    public function randomJobType(){
        $randomNum = rand(1,10);
        switch ($randomNum) {
            case "1":
                return "Transport";
                break;
            case "2":
                return "House Maintenence";
                break;
            case "3":
                return "Tech Maintenence";
                break;
            case "4":
                return "Childcare";
                break;
            case "5":
                return "Food & Drink";
                break;
            case "6":
                return "Health & Beauty";
                break;
            case "7":
                return "Tuition";
                break;
            case "8":
                return "Decoration";
                break;
            case "9":
                return "Guides";
                break;
            case "10":
                return "Housing";
                break;
        }
    }
}
