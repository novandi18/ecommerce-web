<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductColorModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\URI;

class ProductController extends BaseController
{
    protected $db, $pager, $categories, $products, $colors;

    public function __construct()
    {
        $this->db = db_connect();
        $this->pager = service("pager");
        $this->categories = new CategoryModel();
        $this->products = new ProductModel();
        $this->colors = new ProductColorModel();
    }

    public function shop($category = "all")
    {
        $data["title"] = "Shop";
        $data["categories"] = $this->categories->getAll();
        $data["colors"] = $this->colors->findAll();
        $product = $this->products->getAllWithPagination(6, $category);
        $data["products"] = $product["result"];
        $data["links"] = $this->pager->makeLinks($product["page"], $product["perPage"], $product["total"], "bootstrap_pagination");
        $data["total_products"] = $product["total"];
        $data["active"] = $category;
        return view("shop", $data);
    }

    public function productSearch()
    {
        if (@$_GET["search_query"]) {
            $data["title"] = $_GET["search_query"];
            $data["categories"] = $this->categories->getAll();
            $data["colors"] = $this->colors->findAll();
            $product = $this->products->getAllWithPagination(6, $_GET["category"]);
            $data["products"] = $product["result"];
            $data["links"] = $this->pager->makeLinks($product["page"], $product["perPage"], $product["total"], "bootstrap_pagination");
            $data["total_products"] = $product["total"];
            $data["active"] = $_GET["category"];
            return view("shop", $data);
        } else {
            return redirect()->to("/shop");
        }
    }

    public function productSearchProcess()
    {
        $search = $this->request->getVar("search");
        $category = $this->request->getVar("category");
        $param = $this->request->getVar("param");
        $url = "/" . uri_string() . ($param != "" ? "?" . $param . "&search_query=" . $search . "&category=" . $category : "?search_query=" . $search . "&category=" . $category);
        return redirect()->to($url);
    }

    public function productDetail($category, $productName)
    {
        echo $productName;
    }
}
