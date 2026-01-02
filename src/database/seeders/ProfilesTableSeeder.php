<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Profile::insert([
            [
            'id' => 1,
            'user_id' => 1,
            'image' => 'aaa.jpg',
            'postalCode' => '1011111',
            'address' => '東京都大田区',
            'building' => '太田ビル'
            ],
            [
            'id' => 2,
            'user_id' => 2,
            'image' => 'bbb.jpg',
            'postalCode' => '2022222',
            'address' => '千葉県千葉市',
            'building' => '千葉ビル'
            ],
            [
            'id' => 3,
            'user_id' => 3,
            'image' => 'ccc.jpg',
            'postalCode' => '3033333',
            'address' => '埼玉県さいたま市',
            'building' => '埼玉ビル'
            ],
            [
            'id' => 4,
            'user_id' => 4,
            'image' => 'ddd.jpg',
            'postalCode' => '4044444',
            'address' => '神奈川県横浜市',
            'building' => '横浜ビル'
            ],
            [
            'id' => 5,
            'user_id' => 5,
            'image' => 'eee.jpg',
            'postalCode' => '5055555',
            'address' => '茨城県つくば市',
            'building' => '筑波ビル'
            ],
        ]);
    }
}
