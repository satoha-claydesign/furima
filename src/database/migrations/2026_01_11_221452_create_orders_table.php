<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // 商品とのリレーション
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('payment');// 支払い方法 1:'コンビニ払い', 2:'クレジットカード払い'
            $table->integer('order_postalCode');
            $table->string('order_address');
            $table->string('order_building');
            $table->string('status'); // 例: 'pending', 'completed'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
