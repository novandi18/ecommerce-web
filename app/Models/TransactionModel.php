<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transactions';
    protected $primaryKey       = 'id_transaction';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["user_id", "product_id", "quantity"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $db, $carts;

    public function __construct()
    {
        $this->db = db_connect();
        $this->carts = new CartModel();
    }

    public function createOrder($city, $province, $postcode, $notes, $cart)
    {
        $data = [];
        foreach ($cart as $c) {
            $checkStock = $this->carts->checkStockSize($c->size, $c->color_id, $c->product_id);
            if ($checkStock[0]->size > 0) {
                $data[] = [
                    "quantity"    => $c->quantity,
                    "size"        => $c->size,
                    "city"        => $city,
                    "province"    => $province,
                    "postcode"    => $postcode,
                    "order_notes" => $notes,
                    "status"      => "waiting",
                    "user_id"     => session()->id,
                    "product_id"  => $c->product_id,
                    "color_id"    => $c->color_id
                ];

                $this->carts->removeItem($c->id);
            }
        }

        $this->builder($this->table)->insertBatch($data);
        return true;
    }

    public function getTransactionWaiting()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status` FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '1' AND t.user_id = '" . session()->id . "'")->getResult();
        return $q;
    }

    public function getTransactionProcessed()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status` FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '2' AND t.user_id = '" . session()->id . "'")->getResult();
        return $q;
    }

    public function getTransactionShipped()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status` FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '3' AND t.user_id = '" . session()->id . "'")->getResult();
        return $q;
    }

    public function getTransactionDetail($id)
    {
        $q = $this->db->query("SELECT p.photo as photo, c.category_name as category, p.product_name as product, p.price as price, pc.color as color, t.size as size, t.quantity as quantity, t.status as status, u.address as address, t.city as city, t.province as province, t.postcode as postcode, u.phone_number as phone FROM transactions t JOIN products p ON p.id_product = t.product_id JOIN categories c ON c.id_category = p.category_id JOIN product_colors pc ON pc.id_product_color = t.color_id JOIN users u ON u.id_user = t.user_id WHERE t.id_transaction = '$id' AND u.id_user = '" . session()->id . "'")->getResult();
        return $q;
    }
}
