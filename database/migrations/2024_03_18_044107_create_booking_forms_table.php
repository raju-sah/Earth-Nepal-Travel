<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('booking_forms', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Booking Form');
            $table->string('banner_image')->nullable();
            $table->string('content_title')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('booking_forms');
    }
}
