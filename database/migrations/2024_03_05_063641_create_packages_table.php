<?php

use App\Enums\DifficultyLevelType;
use App\Enums\DurationType;
use App\Enums\PackageHighlightType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('duration_type')->default(DurationType::Day->value);
            $table->unsignedSmallInteger('duration_value')->default(0);
            $table->string('difficulty_level')->default(DifficultyLevelType::Easy->value);
            $table->string('difficulty_level_icon')->nullable();
            $table->unsignedSmallInteger('min_age')->nullable();
            $table->unsignedSmallInteger('max_age')->nullable();
            $table->longText('overview')->nullable();
            $table->string('price')->nullable();
            $table->string('starting_location')->nullable();
            $table->string('ending_location')->nullable();
            $table->unsignedSmallInteger('max_altitude')->nullable();
            $table->string('road_map')->nullable();
            $table->text('iframe')->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedInteger('view_count')->default(0);
            $table->string('highlight')->default(PackageHighlightType::None->value);
            $table->string('journey_type')->nullable();
            $table->longText('journey_type_childs')->nullable();
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('packages');
    }
}
