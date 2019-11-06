<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++) { 
            $main_image = $faker->image('public/images/product/thumb/',300,400, null, false);
	    	$product = DB::table('products')->insertGetId([
                'name' => $faker->name,
                'tag_name' => $faker->name,
                'brand_id' => rand(7,8),
                // 'seller_id' => rand(41,62),
                'seller_id' => 41,
                'category' =>  1,
                'first_category' => 1,
                'second_category' => 1,
                'main_image' =>$main_image,
                'short_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'long_description' => $faker->paragraph($nbSentences = 15, $variableNbSentences = true),
                'mrp' => rand(1000,10000),
                'price' => rand(1000,8000),
                'min_ord_qtty' => rand(10,40),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            DB::table('product_colors')
            ->insert([
                'product_id' => $product,
                'color_id' => rand(9,11),
            ]);

            DB::table('product_image')
            ->insert([
                'product_id' => $product,
                'image' => $main_image,
            ]);

    	}
    }
}
