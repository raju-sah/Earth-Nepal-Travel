<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('our_services', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Our Services');
            $table->string('banner_image')->nullable();
            $table->string('image')->nullable();
            $table->string('content_title')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('our_services');
    }
}
