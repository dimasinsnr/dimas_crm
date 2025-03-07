<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVHistoryApprovalView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW v_history_approval AS
            SELECT
                `history_approval`.`history_approval_id` AS `history_approval_id`,
                `history_approval`.`history_approval_customer_id` AS `history_approval_customer_id`,
                `history_approval`.`history_approval_by_user_id` AS `history_approval_by_user_id`,
                `history_approval`.`history_approval_created_at` AS `history_approval_created_at`,
                `customer`.`customer_nama` AS `customer_nama`,
                `users`.`name` AS `name` 
            FROM
                ((
                        `history_approval`
                        LEFT JOIN `customer` ON ((
                                `history_approval`.`history_approval_customer_id` = `customer`.`customer_id` 
                            )))
                    LEFT JOIN `users` ON ((
                        `history_approval`.`history_approval_by_user_id` = `users`.`id` 
                )))
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS v_history_approval');
    }
}