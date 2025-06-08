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
        // Tạo bảng categories trước vì travel_packages cần foreign key tới nó
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
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_package_id')
                ->constrained('travel_packages')
                ->onDelete('cascade'); // đảm bảo xóa travel_packages cũng xóa gallery
            $table->text('path');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->date('travel_date');
            $table->unsignedBigInteger('travel_id');
            $table->foreign('travel_id')->references('id')
                ->on('travel_packages')
                ->onDelete('cascade');
            $table->unsignedBigInteger('payment_status')->default(0);
            $table->unsignedBigInteger('count')->default(0);
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
        // Drop bảng con trước bảng cha để tránh lỗi ràng buộc
        Schema::dropIfExists('orders');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('travel_packages');
        Schema::dropIfExists('categories');
    }
}
