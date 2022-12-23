<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_product" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "product_name" => [
                "type" => "VARCHAR",
                "constraint" => 128
            ],
            "description" => [
                "type" => "TEXT",
            ],
            "price" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "photo" => [
                "type" => "VARCHAR",
                "constraint" => 128
            ],
            "category_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_product", true);
        $this->forge->addForeignKey("category_id", "categories", "id_category", "CASCADE", "CASCADE");
        $this->forge->createTable("products");
    }

    public function down()
    {
        $this->forge->dropTable("products");
    }
}
