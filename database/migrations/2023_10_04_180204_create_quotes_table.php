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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ユーザー情報。ユーザーに関する情報（名前、メールアドレスなど）を参照する外部キー。
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('item_id'); // 商品ID。商品に関する情報（名前など）を参照する外部キー。
            $table->decimal('unit_price', 10, 2);  // 単価。decimal は、10進数の数値を定義。10は合計桁数（整数部と小数部を合わせた桁数）2は小数部の桁数（小数点以下2桁まで）
            $table->integer('quantity');  // 数量
            $table->integer('total_amount'); // 合計金額
            $table->text('remarks')->nullable();
            $table->date('expiration_date');  // 有効期限
            $table->timestamps();

            // 外部キー制約（ユーザー情報）（ users テーブルの id カラムに関連付け）（->onDelete('cascade')は不要？）
            $table->foreign('user_id')->references('id')->on('users');
            
            // 外部キー制約（ユーザー情報を顧客idとして利用）（ users テーブルの id カラムに関連付け）
            $table->foreign('customer_id')->references('id')->on('users');

            // 外部キー制約（商品情報）（ items テーブルの id カラムに関連付け）（->onDelete('cascade')は不要？）
            $table->foreign('item_id')->references('id')->on('items');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
