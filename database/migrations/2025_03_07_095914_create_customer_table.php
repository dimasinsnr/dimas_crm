<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('customer_id', 36);
            $table->string('customer_produk_id', 36);
            $table->string('customer_nama', 64);
            $table->integer('customer_status');
            $table->string('customer_nik', 36);
            $table->bigInteger('customer_phone');
            $table->string('customer_email', 64);
            $table->text('customer_address')->nullable();
            $table->string('customer_by_user_id', 36);
            $table->timestamp('customer_created_at')->nullable();
            $table->timestamp('customer_updated_at')->nullable();
            $table->timestamp('customer_deleted_at')->nullable();
            $table->primary('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}

