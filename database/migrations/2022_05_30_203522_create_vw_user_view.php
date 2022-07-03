<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVwUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `vw_user` AS select `a`.`id` AS `id`,`a`.`id_role` AS `id_role`,`a`.`nama` AS `nama`,`a`.`usia` AS `usia`,`a`.`pekerjaan` AS `pekerjaan`,`a`.`jenis_kelamin` AS `jenis_kelamin`,`a`.`email` AS `email`,`a`.`username` AS `username`,`a`.`password` AS `password`,`a`.`foto_user` AS `foto_user`,`a`.`google_id` AS `google_id`,`a`.`active` AS `active`,`a`.`last_login` AS `last_login`,`a`.`created_by` AS `created_by`,`a`.`created_on` AS `created_on`,`a`.`updated_by` AS `updated_by`,`a`.`updated_on` AS `updated_on`,`b`.`role` AS `role_user`,`b`.`priviledges` AS `priviledges` from (`mental`.`usr_user` `a` left join `mental`.`usr_role` `b` on(`a`.`id_role` = `b`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_user`");
    }
}
