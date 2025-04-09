<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');
            $table->string('location');
            $table->text('description');
            $table->integer('price');
            $table->unsignedBigInteger('category_id'); // Tạo cột khóa ngoại
            $table->foreign('category_id')->references('id')
            ->on('categories')
            ->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->timestamps();

        });
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_package_id')->constrained();
            $table->text('path');
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên khách hàng
            $table->string('phone'); // Số điện thoại khách hàng
            $table->date('travel_date'); // Ngày đi du lịch
            $table->unsignedBigInteger('travel_id'); // Tạo cột khóa ngoại
            $table->foreign('travel_id')->references('id')
            ->on('travel_packages')
            ->onDelete('cascade'); // ID chuyến du lịch
            
            
            $table->unsignedBigInteger('payment_status')->default(0); // Trạng thái thanh toán (pending, paid, failed)
            $table->timestamps(); // Ngày tạo và cập nhật;
            $table->unsignedBigInteger('count')->default(0); // Số lượng vé
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('travel_packages');
        Schema::dropIfExists('categories');
    }
}
