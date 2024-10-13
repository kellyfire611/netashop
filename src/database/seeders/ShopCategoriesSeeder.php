<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [];

        $row1 = [
            'id'            => 1,
            'category_code' => 'CPL',
            'category_name' => 'Chuyên mục chưa phân loại',
            'description'   => 'Chuyên mục mặc định của hệ thống',
            'image'         => 'categories/logo/category-default.png',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        array_push($list, $row1);

        $row2 = [
            'id'            => 2,
            'category_code' => 'MTB',
            'category_name' => 'Máy tính bảng',
            'description'   => 'Các dòng máy tính bảng...',
            'image'         => 'categories/logo/logo-category-tablet.avif',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        array_push($list, $row2);

        $row3 = [
            'id'            => 3,
            'category_code' => 'DT',
            'category_name' => 'Điện thoại thông minh',
            'description'   => 'Các dòng máy điện thoại thông minh...',
            'image'         => 'categories/logo/logo-category-mobile.png',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        array_push($list, $row3);

        // Insert vào database
        DB::table('shop_categories')->insert($list);
    }
}
