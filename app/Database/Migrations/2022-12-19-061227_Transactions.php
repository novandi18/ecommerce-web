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
            "user_id" => [
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

        $this->forge->addKey("id_transaction", true);
        $this->forge->addForeignKey("user_id", "users", "id_user", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("product_id", "products", "id_product", "CASCADE", "CASCADE");
        $this->forge->createTable("transactions");
    }

    public function down()
    {
        $this->forge->dropTable("transactions");
    }
}
