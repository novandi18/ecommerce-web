<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_user" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "user_name" => [
                "type" => "VARCHAR",
                "constraint" => 128
            ],
            "email" => [
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

        $this->forge->addKey("id_user", true);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
