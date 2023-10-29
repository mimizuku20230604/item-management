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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // 一意の識別子
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('unit_price', 10, 2);  // 単価。decimal は、10進数の数値を定義。10は合計桁数（整数部と小数部を合わせた桁数）2は小数部の桁数（小数点以下2桁まで）
            $table->integer('quantity');  // 数量
            $table->integer('total_amount'); // 合計金額
            $table->date('request_date')->nullable(); // NULL許容; // 希望納期
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // NULL許容;
            $table->timestamps(); // 作成日時と更新日時

            // 外部キー制約（ユーザー情報）（ users テーブルの id カラムに関連付け）
            $table->foreign('user_id')->references('id')->on('users');
            // 外部キー制約（ユーザー情報を顧客idとして利用）（ users テーブルの id カラムに関連付け）
            $table->foreign('customer_id')->references('id')->on('users');
            // 外部キー制約（商品情報）（ items テーブルの id カラムに関連付け）
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
