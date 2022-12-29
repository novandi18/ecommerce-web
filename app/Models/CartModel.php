<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'carts';
    protected $primaryKey       = 'id_cart';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["user_id", "product_id", "size", "color_id", "quantity"];

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

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function checkStockSize($size, $color, $product)
    {
        $q = $this->builder("product_sizes as ps")->select("ps.size$size as size, pc.color as color")->join("product_colors as pc", "pc.id_product_color = ps.color_id")->where(["color_id" => $color, "product_id" => $product])->get()->getResult();
        return $q;
    }

    public function addCart($size, $color, $product, $quantity)
    {
        $data = [
            "user_id"    => session()->id,
            "product_id" => $product,
            "size"       => $size,
            "color_id"   => $color,
            "quantity"   => $quantity
        ];
        $q = $this->builder($this->table)->insert($data);
        return ["success" => $q ? true : false];
    }

    public function getTotalItem()
    {
        $q = $this->db->query("SELECT COUNT(c.id_cart) as qty, SUM(p.price * c.quantity) as total FROM carts c JOIN products p ON p.id_product = c.product_id WHERE c.user_id = '" . session()->id . "'")->getResult();
        return ["qty" => $q[0]->qty, "total" => $q[0]->total];
    }

    public function getCartUser()
    {
        $q = $this->db->query("SELECT crt.id_cart as id, p.product_name as product_name, p.price as price, p.photo as photo, c.category_name as category_name, crt.quantity as quantity, crt.size as size, pc.color as color FROM carts crt JOIN products p ON p.id_product = crt.product_id JOIN categories c ON c.id_category = p.category_id JOIN product_colors pc ON pc.id_product_color = crt.color_id WHERE crt.user_id = '" . session()->id . "'")->getResult();
        return $q;
    }

    public function removeItem($id)
    {
        $q = $this->builder($this->table)->delete(["id_cart" => $id, "user_id" => session()->id]);
        return ["result" => $q ? true : false];
    }

    public function updateQty($data)
    {
        $q = $this->builder($this->table)->updateBatch($data, "id_cart");
        return true;
    }
}
