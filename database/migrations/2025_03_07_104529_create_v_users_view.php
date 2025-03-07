<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVUsersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW v_users AS
            SELECT
                `users`.`id` AS `id`,
                `users`.`hak_akses_id` AS `hak_akses_id`,
                `users`.`name` AS `name`,
                `users`.`email` AS `email`,
                `users`.`password` AS `password`,
                `users`.`phone` AS `phone`,
                `users`.`location` AS `location`,
                `users`.`about_me` AS `about_me`,
                `users`.`remember_token` AS `remember_token`,
                `users`.`created_at` AS `created_at`,
                `users`.`updated_at` AS `updated_at`,
                `users`.`deleted_at` AS `deleted_at`,
                `hak_akses`.`hak_akses_kode` AS `hak_akses_kode`,
                `hak_akses`.`hak_akses_nama` AS `hak_akses_nama`,
                `hak_akses`.`hak_akses_status` AS `hak_akses_status`,
                `hak_akses`.`hak_akses_keterangan` AS `hak_akses_keterangan`,
                `hak_akses`.`hak_akses_created_at` AS `hak_akses_created_at`,
                `hak_akses`.`hak_akses_updated_at` AS `hak_akses_updated_at`,
                `hak_akses`.`hak_akses_deleted_at` AS `hak_akses_deleted_at` 
            FROM
                (
                    `users`
                    LEFT JOIN `hak_akses` ON (((
                                `users`.`hak_akses_id` COLLATE utf8mb4_unicode_ci 
                            ) = `hak_akses`.`hak_akses_id` 
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
        DB::statement('DROP VIEW IF EXISTS v_users');
    }
}