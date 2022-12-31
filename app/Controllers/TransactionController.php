<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\TransactionModel;
use App\Models\UserModel;

class TransactionController extends BaseController
{
    protected $db, $carts, $categories, $users, $transactions;

    public function __construct()
    {
        $this->db = db_connect();
        $this->carts = new CartModel();
        $this->categories = new CategoryModel();
        $this->users = new UserModel();
        $this->transactions = new TransactionModel();
    }

    public function checkout()
    {
        $cartUser = $this->carts->getCartUser();
        if (count($cartUser) > 0) {
            $data["title"] = "Checkout";
            $data["cart"] = $this->carts->getTotalItem();
            $data["results"] = $cartUser;
            $data["categories"] = $this->categories->getAll();
            $data["user"] = $this->users->getUserProfile();
            return view("checkout", $data);
        } else {;
            return redirect()->to("/");
        }
    }

    public function checkoutProcess()
    {
        $city = $this->request->getVar("city");
        $province = $this->request->getVar("province");
        $postcode = $this->request->getVar("postcode");
        $notes = $this->request->getVar("notes");
        $cart = $this->carts->getCartUser();
        $order = $this->transactions->createOrder($city, $province, $postcode, $notes, $cart);
        if ($order) {
            return redirect()->to("/profile/transaction");
        }
    }

    public function buy()
    {
        var_dump("OK");
    }
}
