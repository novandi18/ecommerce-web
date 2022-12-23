<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductColors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_product_color" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "color" => [
                "type" => "varchar",
                "constraint" => 64
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_product_color", true);
        $this->forge->createTable("product_colors");
    }

    public function down()
    {
        $this->forge->dropTable("product_colors");
    }
}
