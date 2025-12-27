<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Item::insert([
            [
            'id' => 1,
            'image' => 'image01.jpg',
            'name' => '腕時計',
            'price' => '15000',
            'brand'=> 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => '1',
            ],
            [
            'id' => 2,
            'image' => 'image02.jpg',
            'name' => 'HDD',
            'price' => '5000',
            'brand'=> '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'condition' => '2',
            ],
            [
            'id' => 3,
            'image' => 'image03.jpg',
            'name' => '玉ねぎ3束',
            'price' => '300',
            'brand'=> 'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'condition' => '3',
            ],
            [
            'id' => 4,
            'image' => 'image04.jpg',
            'name' => '革靴',
            'price' => '4000',
            'brand'=> '',
            'description' => 'クラシックなデザインの革靴',
            'condition' => '4',
            ],
            [
            'id' => 5,
            'image' => 'image05.jpg',
            'name' => 'ノートPC',
            'price' => '45000',
            'brand'=> '',
            'description' => '高性能なノートパソコン',
            'condition' => '1',
            ],
            [
            'id' => 6,
            'image' => 'image06.jpg',
            'name' => 'マイク',
            'price' => '8000',
            'brand'=> 'なし',
            'description' => 'ス高音質のレコーディング用マイク',
            'condition' => '2',
            ],
            [
            'id' => 7,
            'image' => 'image07.jpg',
            'name' => 'ショルダーバッグ',
            'price' => '3500',
            'brand'=> '',
            'description' => 'おしゃれなショルダーバッグ',
            'condition' => '3',
            ],
            [
            'id' => 8,
            'image' => 'image08.jpg',
            'name' => 'タンブラー',
            'price' => '500',
            'brand'=> 'なし',
            'description' => '使いやすいタンブラー',
            'condition' => '4',
            ],
            [
            'id' => 9,
            'image' => 'image09.jpg',
            'name' => 'コーヒーミル',
            'price' => '4000',
            'brand'=> 'Starbacks',
            'description' => '手動のコーヒーミル',
            'condition' => '1',
            ],
            [
            'id' => 10,
            'image' => 'image10.jpg',
            'name' => 'メイクセット',
            'price' => '2500',
            'brand'=> '',
            'description' => 'ス便利なメイクアップセット',
            'condition' => '2',
            ],
        ]);
    }
}
