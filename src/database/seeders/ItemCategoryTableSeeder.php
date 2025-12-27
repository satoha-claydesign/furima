<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('item_category')->insert(
        [
        'item_id' => 1,
        'category_id' => 3,
        ]);
        DB::table('item_category')->insert(
        [
        'item_id' => 1,
        'category_id' => 6,
        ]);
        DB::table('item_category')->insert(
        [
        'item_id' => 2,
        'category_id' => 5,
        ]);
        DB::table('item_category')->insert(
        [
        'item_id' => 3,
        'category_id' => 7,
        ]);
        DB::table('item_category')->insert(
        [
        'item_id' => 3,
        'category_id' => 7,
        ]);
        DB::table('item_category')->insert(
        [
        'item_id' => 5,
        'category_id' => 2,
        ]);

    }
}
