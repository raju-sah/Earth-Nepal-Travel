<?php

use App\Enums\BookingType;
use App\Enums\StatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('booking_id')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('return_date')->nullable();
            $table->unsignedInteger('no_of_adults')->nullable();
            $table->unsignedInteger('no_of_child')->nullable();
            $table->unsignedInteger('no_of_infant')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->default(BookingType::Package->value);
            $table->string('status')->default(StatusType::Pending->value);
            $table->text('message')->nullable();
            $table->longText('additional_data')->nullable();
            $table->nullableMorphs('bookable');
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
        Schema::dropIfExists('bookings');
    }
}
