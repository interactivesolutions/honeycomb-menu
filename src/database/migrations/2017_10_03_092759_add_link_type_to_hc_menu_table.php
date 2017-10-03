<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkTypeToHcMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
    public function down()
    {
        Schema::table('hc_menu', function (Blueprint $table) {
            $table->dropColumn('link_type');
        });
    }
}
