<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateVCustomerView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW v_customer AS
            SELECT
                `customer`.`customer_id` AS `customer_id`,
                `customer`.`customer_produk_id` AS `customer_produk_id`,
                `customer`.`customer_nama` AS `customer_nama`,
                `customer`.`customer_status` AS `customer_status`,
                `customer`.`customer_nik` AS `customer_nik`,
                `customer`.`customer_phone` AS `customer_phone`,
                `customer`.`customer_email` AS `customer_email`,
                `customer`.`customer_address` AS `customer_address`,
                `customer`.`customer_by_user_id` AS `customer_by_user_id`,
                `customer`.`customer_created_at` AS `customer_created_at`,
                `customer`.`customer_updated_at` AS `customer_updated_at`,
                `customer`.`customer_deleted_at` AS `customer_deleted_at`,
                `produk`.`produk_nama` AS `produk_nama`,
                `produk`.`produk_harga` AS `produk_harga`,
                `users`.`name` AS `name` 
            FROM
                ((
                        `customer`
                        LEFT JOIN `produk` ON ((
                                `customer`.`customer_produk_id` = `produk`.`produk_id` 
                            )))
                    LEFT JOIN `users` ON ((
                        `customer`.`customer_by_user_id` = `users`.`id` 
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
        DB::statement('DROP VIEW IF EXISTS v_customer');
    }
}