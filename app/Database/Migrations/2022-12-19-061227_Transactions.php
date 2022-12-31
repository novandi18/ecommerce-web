<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id_transaction" => [
                "type" => "INT",
                "auto_increment" => true
            ],
            "quantity" => [
                "type" => "INT",
                "constraint" => 100
            ],
            "size" => [
                "type" => "INT",
                "constraint" => 42,
            ],
            "city" => [
                "type" => "VARCHAR",
                "constraint" => 128,
            ],
            "province" => [
                "type" => "VARCHAR",
                "constraint" => 128,
            ],
            "postcode" => [
                "type" => "INT",
                "constraint" => 10,
            ],
            "order_notes" => [
                "type" => "VARCHAR",
                "constraint" => 256,
            ],
            "user_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "product_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "color_id" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id_transaction", true);
        $this->forge->addForeignKey("user_id", "users", "id_user", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("product_id", "products", "id_product", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("color_id", "product_colors", "id_product_color", "CASCADE", "CASCADE");
        $this->forge->createTable("transactions");
    }

    public function down()
    {
        $this->forge->dropTable("transactions");
    }
}
