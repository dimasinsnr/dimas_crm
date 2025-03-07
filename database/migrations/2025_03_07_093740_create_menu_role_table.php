<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->string('menu_role_id', 36);
            $table->string('menu_role_menu_id', 36);
            $table->string('menu_role_hak_akses_id', 36);
            $table->primary('menu_role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_role');
    }
};
