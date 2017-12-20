<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddLinkTypeToHcMenuTable
 */
class AddLinkTypeToHcMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_menu', function (Blueprint $table) {
            $table->enum('link_type', ['_self', '_blank'])->default('_blank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_menu', function (Blueprint $table) {
            $table->dropColumn('link_type');
        });
    }
}
