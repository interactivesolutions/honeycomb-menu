<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_menu', function(Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('language_code', 36);
            $table->string('parent_id', 36)->nullable();
            $table->string('menu_type_id', 36)->nullable();
            $table->enum('type', ['link', 'page']);
            $table->enum('dropdown', ['0', '1'])->default(0);
            $table->string('icon')->nullable();

            $table->text('url')->nullable();
            $table->text('link_text')->nullable();
            $table->string('page_id')->nullable();
            $table->integer('sequence')->nullable();
        });

        Schema::table('hc_menu', function(Blueprint $table) {
            $table->foreign('language_code')->references('iso_639_1')->on('hc_languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('parent_id')->references('id')->on('hc_menu')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('menu_type_id')->references('id')->on('hc_menu_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_menu', function(Blueprint $table) {
            $table->dropForeign(['language_code']);
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['menu_type_id']);
        });

        Schema::drop('hc_menu');
    }
}
