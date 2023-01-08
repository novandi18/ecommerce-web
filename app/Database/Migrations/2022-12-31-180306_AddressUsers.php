<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddressUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_address" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => 32
            ],
            "address" => [
                "type" => "VARCHAR",
                "constraint" => 128
            ],
            "city" => [
                "type" => "VARCHAR",
                "constraint" => 64
            ],
            "province" => [
                "type" => "VARCHAR",
                "constraint" => 64
            ],
            "postcode" => [
                "type" => "VARCHAR",
                "constraint" => 10
            ],
            "phone_number" => [
                "type" => "VARCHAR",
                "constraint" => 15
            ],
            "user_id" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_address", true);
        $this->forge->addForeignKey("user_id", "users", "id_user", "CASCADE", "CASCADE");
        $this->forge->createTable("address_users");
    }

    public function down()
    {
        $this->forge->dropTable("address_users");
    }
}
