<?php

declare(strict_types = 1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHcMenuTypesTable
 */
class CreateHcMenuTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hc_menu_types', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('hc_menu_types');
    }
}
