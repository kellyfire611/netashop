<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopProductDiscountSeeder extends Seeder
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

        // Vòng lặp
        for($i = 1; $i <= 100; $i++) {
            $is_fixed = $faker->randomElement([0, 1]);
            if($is_fixed == 0) {
                $discount_amount = $faker->randomFloat(1, 2, 15);
            } else if($is_fixed == 1) {
                $discount_amount = $faker->numberBetween(20000, 150000);
            }

            $row = [
                'product_id' => $faker->randomElement($arrProductIds),
                'discount_name' => $faker->words(3, true),
                'discount_amount' => $discount_amount,
                'is_fixed' => $is_fixed,
                'start_date' => $faker->dateTimeBetween('-4 week', 'now'),
                'end_date' => $faker->dateTimeBetween('now', '+4 week'),
                'created_at' => $faker->dateTimeBetween('-4 week', '+4 week'),
            ];
            array_push($list, $row);
        }

        // Insert vào database
        DB::table('shop_product_discounts')->insert($list);
    }
}
