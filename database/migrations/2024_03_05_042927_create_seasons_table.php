<?php

use App\Enums\MonthType;
use App\Enums\SeasonType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->default(SeasonType::AllYearRound->value);
            $table->unsignedSmallInteger('starting_month')->default(MonthType::January->value);
            $table->unsignedSmallInteger('ending_month')->default(MonthType::December->value);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('seasons');
    }
}
