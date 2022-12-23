<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_admin" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "username" => [
                "type" => "VARCHAR",
                "constraint" => 128
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => 256
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_admin", true);
        $this->forge->createTable("admins");
    }

    public function down()
    {
        $this->forge->dropTable("admins");
    }
}
