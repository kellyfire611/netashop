<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopImportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Lấy dữ liệu shop_stores
        $arrStoreIds = DB::table('shop_stores')->pluck('id');
        // Lấy dữ liệu acl_users
        $arrUserIds = DB::table('acl_users')->pluck('id');
        // Lấy dữ liệu shop_products
        $arrProductsIds = DB::table('shop_products')->pluck('id');

        // Vòng lặp tạo 10 phiếu nhập
        for($i = 1; $i <= 10; $i++) {
            $rowImport = [
                'store_id' => $faker->randomElement($arrStoreIds),
                'employee_id' => $faker->randomElement($arrUserIds),
                'import_date' => $faker->dateTimeBetween('-3 months', 'now'),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ];
            // Insert vào database
            $idImport = DB::table('shop_imports')->insertGetId($rowImport);

            // Tạo dữ liệu các dòng con (phiếu nhập chi tiết)
            $tongSoDongCon = $faker->numberBetween(1, 10);
            $listImportDetails = [];

            for($j = 1; $j <= $tongSoDongCon; $j++) {
                $rowImportDetail = [
                    'import_id' => $idImport,
                    'product_id' => $faker->randomElement($arrProductsIds),
                    'quantity' => $faker->numberBetween(1, 100),
                    'unit_price' => $faker->numberBetween(10000, 1500000),
                ];
                array_push($listImportDetails, $rowImportDetail);
            }
            // Insert vào database
            DB::table('shop_import_details')->insert($listImportDetails);
        }
    }
}
