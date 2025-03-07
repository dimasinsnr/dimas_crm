<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->string('menu_id', 36);
            $table->string('menu_kode', 36);
            $table->string('menu_title', 255);
            $table->char('menu_order', 12);
            $table->string('menu_parent', 36)->nullable();
            $table->string('menu_link', 128);
            $table->smallInteger('menu_isaktif');
            $table->smallInteger('menu_level');
            $table->text('menu_icon')->nullable();
            $table->string('menu_description', 255)->nullable();
            $table->primary('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
