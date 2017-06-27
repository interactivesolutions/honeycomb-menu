<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcMenuGroupsMenuConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_menu_groups_menu_connection', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('menu_id', 36);
            $table->string('menu_group_id', 36);
            $table->integer('sequence')->nullable();

            $table->foreign('menu_id')->references('id')->on('hc_menu')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('menu_group_id')->references('id')->on('hc_menu_groups')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_menu_groups_menu_connection', function (Blueprint $table) {
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['menu_group_id']);
        });

        Schema::drop('hc_menu_groups_menu_connection');
    }
}
