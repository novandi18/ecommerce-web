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

    public function createOrder($address, $notes, $cart)
    {
        $data = [];
        foreach ($cart as $c) {
            $checkStock = $this->carts->checkStockSize($c->size, $c->color_id, $c->product_id);
            if ($checkStock[0]->size > 0) {
                $data[] = [
                    "quantity"    => $c->quantity,
                    "size"        => $c->size,
                    "order_notes" => $notes,
                    "status"      => "1",
                    "address_id"  => $address,
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

    public function getTransactionCanceled()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status` FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '0' AND t.user_id = '" . session()->id . "' ORDER BY t.id_transaction DESC")->getResult();
        return $q;
    }

    public function getTransactionWaiting()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status`, t.snap_token as snap_token, t.payment_deadline as payment_deadline, t.order_id as order_id FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status IN ('1','2') AND t.user_id = '" . session()->id . "' ORDER BY t.id_transaction DESC")->getResult();
        return $q;
    }

    public function getTransactionProcessed()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, t.size as size, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status`, p.id_product as id_product, t.color_id as color_id FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '3' AND t.user_id = '" . session()->id . "' ORDER BY t.id_transaction DESC")->getResult();
        return $q;
    }

    public function getTransactionShipped()
    {
        $q = $this->db->query("SELECT t.id_transaction as id_transaction, p.product_name as product_name, t.quantity as quantity, (t.quantity * p.price) as total, t.created_at as `order`, t.status as `status` FROM transactions t JOIN products p ON p.id_product = t.product_id WHERE t.status = '4' AND t.user_id = '" . session()->id . "' ORDER BY t.id_transaction DESC")->getResult();
        return $q;
    }

    public function getTransactionDetail($id)
    {
        $q = $this->db->query("SELECT p.photo as photo, c.category_name as category, p.product_name as product, p.price as price, pc.color as color, t.size as size, t.quantity as quantity, t.status as status, au.address as address, au.city as city, au.province as province, au.postcode as postcode, au.phone_number as phone FROM transactions t JOIN products p ON p.id_product = t.product_id JOIN categories c ON c.id_category = p.category_id JOIN product_colors pc ON pc.id_product_color = t.color_id JOIN address_users au ON au.id_address = t.address_id WHERE t.id_transaction = '" . $id . "' AND t.user_id = '" . session()->id . "'")->getResult();
        return $q;
    }

    public function cancelTransaction($data)
    {
        $q = $this->builder($this->table)->updateBatch($data, "id_transaction");
        return true;
    }

    public function getTransactionToBuy($id)
    {
        $q = $this->db->query("SELECT t.id_transaction as id, p.product_name as `name`, t.quantity as quantity, p.price as price, u.user_name as first_name, u.email as email, au.address as address, au.city as city, au.postcode as postal_code, au.phone_number as phone FROM transactions t JOIN products p ON p.id_product = t.product_id JOIN address_users au ON au.id_address = t.address_id JOIN users u ON u.id_user = t.user_id WHERE id_transaction IN ($id)")->getResult();
        return $q;
    }
}
