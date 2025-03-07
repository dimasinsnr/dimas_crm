<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_approval', function (Blueprint $table) {
            $table->string('history_approval_id', 36);
            $table->string('history_approval_customer_id', 36);
            $table->string('history_approval_by_user_id', 36);
            $table->timestamp('history_approval_created_at')->nullable();
            $table->primary('history_approval_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_approval');
    }
}

