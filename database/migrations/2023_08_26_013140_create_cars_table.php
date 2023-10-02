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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('car_location');
            $table->text('car_desc')->nullable();
            $table->decimal('car_price', 10, 2);
            $table->string('car_image');
            $table->boolean('car_availability')->default(true);
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
