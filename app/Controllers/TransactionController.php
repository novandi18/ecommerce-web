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
            $data["address"] = $this->users->getUserAddress();
            return view("checkout", $data);
        } else {;
            return redirect()->to("/");
        }
    }

    public function checkoutProcess()
    {
        $address = $this->request->getVar("address");
        $notes = $this->request->getVar("notes");
        $cart = $this->carts->getCartUser();
        $order = $this->transactions->createOrder($address, $notes, $cart);
        if ($order) {
            return redirect()->to("/profile/transaction");
        }
    }

    public function buy()
    {
        if ($this->request->isAJAX()) {
            \Midtrans\Config::$serverKey = 'SB-Mid-server-QF29mMsRPIg7o3FWyiRzRByI';
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $transaction = json_decode($this->request->getVar("transaction"));
            $products = $this->transactions->getTransactionToBuy(implode(",", $transaction));
            $orderId = rand();

            $items = [];
            $gross_amount = 0;
            foreach ($products as $product) {
                $items[] = [
                    "id" => $product->id,
                    "price" => $product->price,
                    "quantity" => $product->quantity,
                    "name" => $product->name,
                ];

                $gross_amount += $product->price;
            }

            $shipping_address = array(
                'first_name'   => $products[0]->first_name,
                'address'      => $products[0]->address,
                'city'         => $products[0]->city,
                'postal_code'  => $products[0]->postal_code,
                'phone'        => $products[0]->phone,
                'country_code' => 'IDN'
            );

            $customer_details = array(
                'first_name'       => $products[0]->first_name,
                'phone'            => $products[0]->phone,
                'email'            => $products[0]->email,
                'shipping_address' => $shipping_address
            );

            $params = [
                "transaction_details" => array(
                    "order_id" => $orderId,
                    "gross_amount" => $gross_amount
                ),
                "item_details" => $items,
                "customer_details" => $customer_details
            ];

            $result = [
                "snapToken" => \Midtrans\Snap::getSnapToken($params),
                "success" => true
            ];

            echo json_encode($result);
        } else {
            return redirect()->to("/profile/transaction");
        }
    }

    public function continuePay()
    {
        if ($this->request->isAJAX()) {
            $transaction = json_decode($this->request->getVar("transaction"));
            $token = $this->request->getVar("token");
            $payment_deadline = $this->request->getVar("payment_deadline");
            $order_id = $this->request->getVar("order_id");

            $data = [];
            foreach ($transaction as $t) {
                $data[] = [
                    "id_transaction" => $t,
                    "status" => "2",
                    "order_id" => $order_id,
                    "snap_token" => $token,
                    "payment_deadline" => $payment_deadline
                ];
            }

            $this->db->table("transactions")->updateBatch($data, "id_transaction");
            echo json_encode(array("success" => true));
        }
    }

    public function cancelOrder()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-QF29mMsRPIg7o3FWyiRzRByI';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $id = $this->request->getVar("transaction");
        $orderid = $this->db->table("transactions")->select("order_id")->where("id_transaction", $id[0])->get()->getResult();
        $cancel = \Midtrans\Transaction::cancel($orderid[0]->order_id);

        $data = [];
        foreach ($id as $transaction) {
            $data[] = [
                "id_transaction" => $transaction,
                "status" => "0",
                "order_id" => null,
                "snap_token" => null,
                "payment_deadline" => null
            ];
        }
        $this->transactions->cancelTransaction($data);
        return redirect()->to("/profile/transaction/canceled");
    }

    public function arrived()
    {
        $transaction = $this->request->getVar("transaction");
        // $data = [];
        foreach ($transaction as $t) {
            $ex = explode("-", $t);

            $data[] = [
                "id_transaction" => $ex[0],
                "status" => "4"
            ];

            $this->db->table("products")->set("sold", "sold+" . $ex[2], false)->where("id_product", $ex[1])->update();

            $this->db->table("product_sizes")->set("`size" . $ex[4] . "`", "`size" . $ex[4] . "`-" . $ex[2], false)->where(["product_id" => $ex[1], "color_id" => $ex[3]])->update();
        }

        $this->db->table("transactions")->updateBatch($data, "id_transaction");
        return redirect()->to("/profile/transaction/shipped");
    }
}
