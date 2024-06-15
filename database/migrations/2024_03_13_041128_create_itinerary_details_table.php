<?php

use App\Enums\ItineraryDurationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('itinerary_details', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->unsignedInteger('duration_value');
            $table->string('duration_unit')->default(ItineraryDurationType::Hour->value);
            $table->unsignedInteger('order')->default(0);
            $table->text('description')->nullable();
            $table->foreignId('package_id')->constrained('packages')->cascadeOnDelete();
            $table->foreignId('itinerary_id')->constrained('itineraries')->cascadeOnDelete();
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
        Schema::dropIfExists('itinerary_details');
    }
}
