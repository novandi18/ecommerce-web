<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoryModel;

class CartController extends BaseController
{
    protected $db, $carts, $categories;

    public function __construct()
    {
        $this->db = db_connect();
        $this->carts = new CartModel();
        $this->categories = new CategoryModel();
    }

    public function cart()
    {
        $data["title"] = "Your Cart";
        $data["cart"] = $this->carts->getTotalItem();
        $data["results"] = $this->carts->getCartUser();
        $data["categories"] = $this->categories->getAll();
        return view("cart", $data);
    }

    public function addToCart()
    {
        if (session()->isLoggedIn) {
            $url = $this->request->getVar("url");
            $product = $this->request->getVar("product");
            $color = $this->request->getVar("color");
            $size = $this->request->getVar("size");
            $quantity = $this->request->getVar("quantity");
            if (isset($product, $color, $size) && (int) $quantity > 0) {
                $checkStock = $this->carts->checkStockSize($size, $color, $product)[0];
                if ((int) $checkStock->size > 0) {
                    $insert = $this->carts->addCart($size, $color, $product, $quantity);
                    if ($insert["success"]) {
                        session()->setFlashdata("success", "Product has been added to your cart.");
                        return redirect()->to($url);
                    }
                } else {
                    session()->setFlashdata("error", "This product is for size <strong>" . $size . "</strong> and the <strong>" . $checkStock->color . "</strong> color is out of stock");
                    return redirect()->to($url);
                }
            } else {
                if (!@$size) {
                    session()->setFlashdata("error", "Product size must be checked.");
                } else if ((int) $quantity < 1) {
                    session()->setFlashdata("error", "Quantity must have more than 0.");
                }

                return redirect()->to($url);
            }
        }
    }

    public function deleteFromCart($id)
    {
        $delete = $this->carts->removeItem($id);
        if ($delete["result"]) {
            session()->setFlashdata("success", "Product has been removed from your cart.");
        } else {
            session()->setFlashdata("error", "There is something wrong to remove product from your cart.");
        }

        return redirect()->to("/cart");
    }

    public function cartToCheckout()
    {
        $qty = $this->request->getVar("qty");
        $cart = $this->request->getVar("cart");

        if (isset($qty, $cart)) {
            $qtyData = [];
            for ($i = 0; $i < count($cart); $i++) {
                $qtyData[] = array("id_cart" => $cart[$i], "quantity" => $qty[$i]);
            }

            $this->carts->updateQty($qtyData);
            return redirect()->to("/checkout");
        } else {
            return redirect()->to("/cart");
        }
    }
}
