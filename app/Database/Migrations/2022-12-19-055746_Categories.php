<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_category" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "category_name" => [
                "type" => "varchar",
                "constraint" => 128
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_category", true);
        $this->forge->createTable("categories");
    }

    public function down()
    {
        $this->forge->dropTable("categories");
    }
}
