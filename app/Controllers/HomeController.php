<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    protected $db, $categories, $products;

    public function __construct()
    {
        $this->db = db_connect();
        $this->categories = new CategoryModel();
        $this->products = new ProductModel();
    }

    public function index()
    {
        $data["title"] = "Home";
        $data["categories"] = $this->categories->getAll();
        $data["categoryProduct"] = $this->products->getProductsPerCategory();
        $data["featured"] = $this->products->getFeaturedProducts();
        $data["latest"] = $this->products->getLatestProducts();
        $data["bestPrice"] = $this->products->getBestPriceProducts();
        $data["topProducts"] = $this->products->getTopProducts();
        return view("home", $data);
    }
}
