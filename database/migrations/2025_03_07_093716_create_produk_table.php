<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->string('produk_id', 36);
            $table->string('produk_kode', 36);
            $table->string('produk_nama', 64);
            $table->text('produk_deskripsi');
            $table->string('produk_harga', 36);
            $table->timestamp('produk_created_at')->nullable();
            $table->timestamp('produk_updated_at')->nullable();
            $table->timestamp('produk_deleted_at')->nullable();
            $table->primary('produk_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
