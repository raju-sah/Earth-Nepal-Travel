<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_caption')->nullable();
            $table->boolean('status')->default(1);
            $table->decimal('latitude',20,16)->nullable();
            $table->decimal('longitude',20,16)->nullable();
            $table->boolean('is_featured')->default(0);
            $table->string('country')->default('Nepal');
            $table->unsignedInteger('view_count')->default(0);
            $table->foreignId('parent_id')->nullable()->default(null)->constrained('destinations')->nullOnDelete();
            $table->foreignId('destination_category_id')->constrained('destination_categories')->cascadeOnDelete();
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
        Schema::dropIfExists('destinations');
    }
}
