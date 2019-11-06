<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;


class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 22; $i++) { 
	    	$seller = DB::table('seller')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->email,
                'mobile' => $faker->e164PhoneNumber,
                'password' =>'$2y$10$pui1g8DKDKxkjYRdtH66YOTBzMoAhfwD2ojME/WpwSm8xYxd.3K9y',
                'user_role' => 2,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            DB::table('seller_details')
            ->insert([
                'seller_id' => $seller,
            ]);

            DB::table('seller_bank')
            ->insert([
                'seller_id' => $seller,
            ]);

    	}
    }
}
