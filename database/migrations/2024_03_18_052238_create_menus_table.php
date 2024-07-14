<?php

use App\Enums\MenuType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('classes')->nullable();
            $table->string('target')->default('_self');
            $table->foreignId('parent_id')->nullable()->default(null)->constrained('menus')->nullOnDelete();
            $table->string('url')->nullable();
            $table->string('menu_type')->default(MenuType::Default->value);
            $table->foreignId('base_menu_id')->constrained('base_menus')->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_clickable')->default(1);
            $table->nullableMorphs('menuable');
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
        Schema::dropIfExists('menus');
    }
}
