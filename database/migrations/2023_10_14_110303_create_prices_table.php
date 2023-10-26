<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('customer_id')->nullable(); // NULL許容
            $table->decimal('registration_price', 10, 2);
            $table->date('deadline_date')->nullable(); // NULL許容
            $table->text('remark')->nullable(); // NULL許容
            $table->timestamps();

            // 外部キー制約（ユーザー情報）（ users テーブルの id カラムに関連付け）
            $table->foreign('user_id')->references('id')->on('users');
            // 外部キー制約（ユーザー情報を顧客idとして利用）（ users テーブルの id カラムに関連付け）
            $table->foreign('customer_id')->references('id')->on('users');
            // 外部キー制約（商品情報）（ items テーブルの id カラムに関連付け）
            $table->foreign('item_id')->references('id')->on('items');

            // ユニーク制約（同じ商品・顧客の組合せ重複を防ぐ）
            $table->unique(['item_id', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
