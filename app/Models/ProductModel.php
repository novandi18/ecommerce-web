<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id_product';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["product_name", "description", "price", "photo", "category_id"];

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

    // Get all products
    public function getAllWithPagination($perPage, $category)
    {
        $page = @$_GET["page"] ? $_GET["page"] : 1; // Page
        $search = @$_GET["search_query"] ? $_GET["search_query"] : ""; // Search
        $offset = ($page - 1) * $perPage; // Offset
        $wCategory = $category !== "all" ? explode("-", $category) : [""]; // Category
        $min = @$_GET["min"] ? $_GET["min"] : 0; // Min. Price
        $max = @$_GET["max"] ? $_GET["max"] : 5000000; // Max. Price
        $sortby = @$_GET["sort"] && $_GET["sort"] !== "relevance" ? $_GET["sort"] : ""; // Sort by
        $price = @$_GET["price"] && $_GET["price"] !== "all" ? $_GET["price"] : ""; // Sort price

        $sortingPrice = $price != "" ? ($price == "low-high" ? "p.price ASC" : "p.price DESC") : "";
        $sortingSortby = $sortby != "" ? ($sortby == "latest" ? ($price == "" ? "" : ", ") . "p.id_product DESC" : ($price == "" ? "" : ", ") . "p.sold DESC") : "";

        $data = $this->db->query("SELECT p.id_product as id_product, p.product_name as product, p.price as price, p.photo as photo, c.category_name as category FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id WHERE p.product_name LIKE '%" . $search . "%' AND c.category_name LIKE '%" . $wCategory[count($wCategory) - 1] . "' AND p.price >= $min AND p.price <= $max " . ($sortby == "" && $price == "" ? "" : "ORDER BY") . " " . $sortingPrice . $sortingSortby . " LIMIT $perPage OFFSET $offset")->getResult();

        $total = count($this->db->query("SELECT p.id_product FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id WHERE p.product_name LIKE '%" . $search . "%' AND c.category_name LIKE '%" . $wCategory[count($wCategory) - 1] . "' AND p.price >= $min AND p.price <= $max " . ($sortby == "" && $price == "" ? "" : "ORDER BY") . " " . $sortingPrice . $sortingSortby . "")->getResult());

        return ["result" => $data, "page" => $page, "perPage" => $perPage, "total" => $total];
    }

    // Get single product by name
    public function getProduct($name, $category)
    {
        $productName = str_replace("-", " ", $name);
        $categoryName = explode("-", $category);

        // Product
        $product = $this->db->query("SELECT p.id_product as id_product, p.product_name as product_name, p.description as description, p.price as price, p.photo as photo, p.sold as sold, c.category_name as category FROM `products` p JOIN categories c ON c.id_category = p.category_id WHERE p.product_name LIKE '%" . $productName . "%' AND c.category_name LIKE '%" . $categoryName[count($categoryName) - 1] . "'")->getResult();

        // Id product
        $id = $product[0]->id_product;
        // Size and Color
        $sizeColor = $this->db->query("SELECT ps.size35 as size35, ps.size36 as size36, ps.size37 as size37, ps.size38 as size38, ps.size39 as size39, ps.size40 as size40, ps.size41 as size41, ps.size42 as size42, pc.id_product_color as id, pc.color as color FROM product_sizes ps JOIN product_colors pc ON pc.id_product_color = ps.color_id WHERE ps.product_id = '$id'")->getResult();

        // Related Products
        $related = $this->db->query("SELECT p.product_name as product_name, p.price as price, p.photo as photo FROM products p JOIN categories c ON c.id_category = p.category_id WHERE c.category_name LIKE '%" . $categoryName[count($categoryName) - 1] . "' AND p.id_product != '$id' ORDER BY RAND() LIMIT 4")->getResult();

        return ["product" => $product, "sizeColor" => $sizeColor, "related" => $related];
    }

    // Get products per category
    public function getProductsPerCategory()
    {
        $q = $this->db->query("SELECT p.photo as photo, c.category_name as category FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id GROUP BY p.category_id");
        return $q->getResult();
    }

    // Get featured products
    public function getFeaturedProducts()
    {
        $q = $this->db->query("SELECT c.category_name as category_name, id_product, product_name, photo, price FROM ( SELECT id_product, product_name, category_id, photo, price, ROW_NUMBER() OVER (PARTITION BY category_id ORDER BY category_id DESC) AS x FROM " . $this->table . " ) RNK JOIN categories c ON c.id_category = category_id WHERE x <= 2");
        return $q->getResult();
    }

    // Get latest products
    public function getLatestProducts()
    {
        $q = $this->db->query("SELECT p.id_product as id_product, p.product_name as product_name, p.price as price, p.photo as photo, c.category_name as category_name FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id ORDER BY p.id_product DESC LIMIT 3");
        return $q->getResult();
    }

    // Get best price products
    public function getBestPriceProducts()
    {
        $q = $this->db->query("SELECT p.id_product as id_product, p.product_name as product_name, p.price as price, p.photo as photo, c.category_name as category_name FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id ORDER BY p.price ASC LIMIT 3");
        return $q->getResult();
    }

    // Get top products
    public function getTopProducts()
    {
        $q = $this->db->query("SELECT p.id_product as id_product, p.product_name as product_name, p.price as price, p.photo as photo, c.category_name as category_name FROM " . $this->table . " p JOIN categories c ON c.id_category = p.category_id ORDER BY p.price DESC LIMIT 3");
        return $q->getResult();
    }
}
