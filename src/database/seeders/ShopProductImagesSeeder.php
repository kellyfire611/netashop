<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $list = [];

        // Lấy dữ liệu products
        $arrProductIds = DB::table('shop_products')->pluck('id');
        //dd($arrProductIds);

        // Vòng lặp
        for($i = 1; $i <= 100; $i++) {
            $row = [
                'product_id' => $faker->randomElement($arrProductIds),
                'image' => 'products/product-' . $faker->numberBetween(1, 3) . '.jpg',
                'created_at' => $faker->dateTimeBetween('-4 week', '+4 week')
            ];
            array_push($list, $row);
        }

        // Insert vào database
        DB::table('shop_product_images')->insert($list);
    }
}
