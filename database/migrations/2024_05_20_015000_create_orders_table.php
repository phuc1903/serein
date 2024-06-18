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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->longText('address');
            $table->enum('payment_method', ['momo', 'cod'])->default('cod');
            $table->bigInteger('total_price');
            $table->enum('status', ['Đang giao hàng', 'Đang xét duyệt', 'Giao hàng thành công', 'Đã hủy'])->default('Đang xét duyệt');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
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
