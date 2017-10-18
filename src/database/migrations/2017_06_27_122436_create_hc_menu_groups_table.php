<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcMenuGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_menu_groups', function(Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('language_code', 36);
            $table->string('name', 191);
            $table->integer('sequence')->nullable();
        });

        Schema::table('hc_menu_groups', function(Blueprint $table) {
            $table->foreign('language_code')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_menu_groups', function(Blueprint $table) {
            $table->dropForeign(['language_code']);
        });

        Schema::drop('hc_menu_groups');
    }
}