<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ShopUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $list = [];

        $row = [
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'last_name' => 'Quản trị',
            'first_name' => 'Hệ thống',
            'gender' => '0',
            'email' => 'admin@netashop.com',
            'birthday' => date('Y-m-d H:i:s'),
            'avatar' => 'users/avatar/avatar-defualt-nam.png',
            'code' => 'NV001',
            'job_title' => 'Quản trị',
            'department' => 'Phòng IT',
            'manager_id' => NULL,
            'phone' => '0915659223',
            'address1' => 'Ninh Kiều, TP Cần Thơ',
            'address2' => '',
            'city' => 'Cần Thơ',
            'state' => '',
            'postal_code' => '900000',
            'country' => 'Việt Nam',
            'remember_token' => '',
            'active_code' => '',
            'status' => 1, // #1: Đang sử dụng; #0: ngưng sử dụng
            'created_at' => date('Y-m-d H:i:s'),
        ];
        array_push($list, $row);

        for($i = 1; $i <= 10; $i++) {
            $row = [
                'username' => $faker->word(),
                'password' => bcrypt('123456'),
                'last_name' => $faker->word(),
                'first_name' => $faker->word(),
                'gender' => $faker->randomElement([0, 1]),
                'email' => $faker->email(),
                'birthday' => $faker->dateTimeBetween('-30 years', 'now'),
                'avatar' => 'users/avatar/' . $faker->randomElement(['avatar-defualt-nam.png', 'avatar-defualt-nu.jpg']),
                'code' => $faker->word(),
                'job_title' => $faker->word(),
                'department' => $faker->word(),
                'manager_id' => NULL,
                'phone' => $faker->phoneNumber(),
                'address1' => $faker->address(),
                'address2' => $faker->address(),
                'city' => $faker->city(),
                'state' => $faker->state(),
                'postal_code' => $faker->postcode(),
                'country' => $faker->country(),
                'remember_token' => '',
                'active_code' => $faker->uuid(),
                'status' => 2, //#0: ngưng sử dụng; #1: Đang sử dụng; #2: Chưa kích hoạt
                'created_at' => date('Y-m-d H:i:s'),
            ];
            array_push($list, $row);
        }

        // Insert vào database
        DB::table('acl_users')->insert($list);
    }
}
