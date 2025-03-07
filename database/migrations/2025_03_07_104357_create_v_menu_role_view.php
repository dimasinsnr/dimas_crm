<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVMenuRoleView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW v_menu_role AS
            SELECT
                `menu_role`.`menu_role_id` AS `menu_role_id`,
                `menu_role`.`menu_role_menu_id` AS `menu_role_menu_id`,
                `menu_role`.`menu_role_hak_akses_id` AS `menu_role_hak_akses_id`,
                `menu`.`menu_kode` AS `menu_kode`,
                `menu`.`menu_title` AS `menu_title`,
                `menu`.`menu_order` AS `menu_order`,
                `menu`.`menu_parent` AS `menu_parent`,
                `menu`.`menu_link` AS `menu_link`,
                `menu`.`menu_isaktif` AS `menu_isaktif`,
                `menu`.`menu_level` AS `menu_level`,
                `menu`.`menu_icon` AS `menu_icon`,
                `menu`.`menu_description` AS `menu_description` 
            FROM
                (
                    `menu_role`
                    LEFT JOIN `menu` ON ((
                        `menu_role`.`menu_role_menu_id` = `menu`.`menu_id` 
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
        DB::statement('DROP VIEW IF EXISTS v_menu_role');
    }
}