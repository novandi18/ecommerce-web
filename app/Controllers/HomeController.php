<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    protected $db, $categories, $products, $carts;

    public function __construct()
    {
        $this->db = db_connect();
        $this->categories = new CategoryModel();
        $this->products = new ProductModel();
        $this->carts = new CartModel();
    }

    public function index()
    {
        $data["title"] = "Home";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        $data["categoryProduct"] = $this->products->getProductsPerCategory();
        $data["featured"] = $this->products->getFeaturedProducts();
        $data["latest"] = $this->products->getLatestProducts();
        $data["bestPrice"] = $this->products->getBestPriceProducts();
        $data["topProducts"] = $this->products->getTopProducts();
        return view("home", $data);
    }
}
