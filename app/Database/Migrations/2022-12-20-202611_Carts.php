<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Carts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_cart" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "user_id" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "product_id" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "color_id" => [
                "type" => "INT",
                "constraint" => 11
            ],
            "size" => [
                "type" => "INT",
                "constraint" => 42
            ],
            "quantity" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_cart", true);
        $this->forge->addForeignKey("user_id", "users", "id_user", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("product_id", "products", "id_product", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("color_id", "product_colors", "id_product_color", "CASCADE", "CASCADE");
        $this->forge->createTable("carts");
    }

    public function down()
    {
        $this->forge->dropTable("carts");
    }
}
