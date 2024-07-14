<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->unsignedInteger('day')->default(1);
            $table->text('description')->nullable();
            $table->string('max_altitude')->nullable();
            $table->string('meals')->nullable();
            $table->string('accommodation')->nullable();
            $table->string('transportation')->nullable();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
}
