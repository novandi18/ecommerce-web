<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductSizes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_product_size" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "size35" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size36" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size37" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size38" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size39" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size40" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size41" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size42" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "color_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "product_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_product_size", true);
        $this->forge->addForeignKey("product_id", "products", "id_product", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("color_id", "product_colors", "id_product_color", "CASCADE", "CASCADE");
        $this->forge->createTable("product_sizes");
    }

    public function down()
    {
        $this->forge->dropTable("product_sizes");
    }
}
