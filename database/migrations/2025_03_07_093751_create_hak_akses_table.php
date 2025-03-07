<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHakAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->string('hak_akses_id', 36);
            $table->string('hak_akses_kode', 12);
            $table->string('hak_akses_nama', 64);
            $table->smallInteger('hak_akses_status')->nullable();
            $table->text('hak_akses_keterangan')->nullable();
            $table->timestamp('hak_akses_created_at')->nullable();
            $table->timestamp('hak_akses_updated_at')->nullable();
            $table->timestamp('hak_akses_deleted_at')->nullable();
            $table->primary('hak_akses_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_akses');
    }
};
