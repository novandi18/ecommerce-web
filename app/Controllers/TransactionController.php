<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoryModel;

class TransactionController extends BaseController
{
    protected $db, $carts, $categories;

    public function __construct()
    {
        $this->db = db_connect();
        $this->carts = new CartModel();
        $this->categories = new CategoryModel();
    }

    public function checkout()
    {
        $data["title"] = "Checkout";
        $data["cart"] = $this->carts->getTotalItem();
        $data["results"] = $this->carts->getCartUser();
        $data["categories"] = $this->categories->getAll();
        return view("checkout", $data);
    }
}
