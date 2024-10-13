<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $list = [];

        // Lấy dữ liệu suppliers
        $arrSupplierIds = DB::table('shop_suppliers')->pluck('id');
        // Lấy dữ liệu categories
        $arrCategoriesIds = DB::table('shop_categories')->pluck('id');

        $row1 = [
            'product_code' => '8U237PA',
            'product_name' => 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11 (8U237PA)',
            'image' => 'products/hp-15s.jpg',
            'short_description' => 'Hư gì đổi nấy 12 tháng tại 2966 siêu thị toàn quốc (miễn phí tháng đầu). Bảo hành chính hãng laptop 1 năm tại các trung tâm bảo hành hãng Xem địa chỉ bảo hành. Bộ sản phẩm gồm: Sách hướng dẫn, Thùng máy, Sạc Laptop HP ( 45W )',
            'description' => 'HP Probook 450 G5
                            CPU : Intel Core i5 7200
                            Ram : 8Gb DDR4
                            Ổ cứng : SSD 128GB 2.5"
                            Màn hình 15.6 inch FULL HD
                            Độ phân giải 1920 x 1080 pixels
                            Công nghệ màn : Anti Glare LED backlit
                            VGA on : Intel HD Graphics 620
                            Tình trạng: Đã sử dụng
                            Nguồn gốc: Xách tay Nhật
                            #laptopcu
                            #laptopgiare',
            'standard_code' => '6600000',
            'list_price' => '7000000',
            'quantity_per_unit' => '15',
            'discontinued' => '0',
            'is_featured' => '1',
            'is_new' => '1',
            'category_id' => 1,
            'supplier_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        array_push($list, $row1);

        // Vòng lặp
        for($i = 1; $i <= 100; $i++) {
            $row = [
                'product_code' => $faker->regexify('[A-Z]{5}[0-4]{3}'),
                'product_name' => $faker->words(3, true),
                'image' => 'products/product-' . $faker->numberBetween(1, 3) . '.jpg',
                'short_description' => $faker->sentence(),
                'description' => $faker->paragraph(2, true),
                'standard_code' => $faker->numberBetween(20000, 15000000),
                'list_price' => $faker->numberBetween(20000, 15000000),
                'quantity_per_unit' => $faker->numberBetween(1, 50),
                'discontinued' => $faker->randomElement([0, 1]),
                'is_featured' => $faker->randomElement([0, 1]),
                'is_new' => $faker->randomElement([0, 1]),
                'category_id' => $faker->randomElement($arrCategoriesIds),
                'supplier_id' => $faker->randomElement($arrSupplierIds),
                'created_at' => date('Y-m-d H:i:s')
            ];
            array_push($list, $row);
        }

        // Insert vào database
        DB::table('shop_products')->insert($list);
    }
}
