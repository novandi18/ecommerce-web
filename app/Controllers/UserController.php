<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\TransactionModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $db, $users, $categories, $carts, $transactions;

    public function __construct()
    {
        $this->db = db_connect();
        $this->users = new UserModel();
        $this->categories = new CategoryModel();
        $this->carts = new CartModel();
        $this->transactions = new TransactionModel();
        helper(["form", "url"]);
    }

    // Login form
    public function login()
    {
        $data["title"] = "Login to Your Account";
        $data["categories"] = $this->categories->getAll();
        return view("login", $data);
    }

    // Register form
    public function register()
    {
        $data["title"] = "Register Account";
        $data["categories"] = $this->categories->getAll();
        return view("register", $data);
    }

    // Login process
    public function loginProcess()
    {
        $validation = $this->validate([
            "email" => ["label" => "Email", "rules" => "required|valid_email", "errors" => [
                "required" => "Enter your email.",
                "valid_email" => "Please enter a valid email address."
            ]],
            "password" => ["label" => "Password", "rules" => "required", "errors" => [
                "required" => "Enter your password."
            ]]
        ]);

        if (!$validation) return $this->login();

        $user_exist = $this->users->checkUser("email", $this->request->getVar("email"));
        if ($user_exist) {
            $pass_match = password_verify($this->request->getVar("password"), $user_exist->password);
            if ($pass_match) {
                $session_data = [
                    "id" => $user_exist->id_user,
                    "name" => $user_exist->user_name,
                    "email" => $user_exist->email,
                    "isLoggedIn" => TRUE
                ];
                session()->set($session_data);
                return redirect()->to("/");
            } else {
                session()->setFlashdata("error", "User does not exist.");
                return redirect()->to("/login");
            }
        } else {
            session()->setFlashdata("error", "User does not exist.");
            return redirect()->to("/login");
        }
    }

    // Registration process
    public function registerProcess()
    {
        $validation = $this->validate([
            "name" => ["label" => "Name", "rules" => "required|min_length[5]", "errors" => [
                "required" => "Please enter your name.",
                "min_length" => "Name must be atleast 5 characters long."
            ]],
            "email" => ["label" => "Email", "rules" => "required|valid_email|is_unique[users.email]", "errors" => [
                "required" => "Enter your email.",
                "valid_email" => "Please enter a valid email address.",
                "is_unique" => "The email already exists, try another email."
            ]],
            "password" => ["label" => "Password", "rules" => "required|min_length[5]|alpha_numeric", "errors" => [
                "required" => "Enter your password.",
                "min_length" => "Password must be atleast 5 digits.",
                "alpha_numeric" => "Password must contain alpha numeric"
            ]],
            "password_confirm" => ["label" => "Confirm Password", "rules" => "required|matches[password]", "errors" => [
                "required" => "Re-enter your password.",
                "matches" => "Confirm password and password must be same."
            ]],
            "accept" => "required",
        ]);

        if (!$validation) return $this->register();

        $data = [
            "user_name" => $this->request->getVar("name"),
            "email" => $this->request->getVar("email"),
            "password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
        ];

        $create = $this->users->save($data);
        if ($create) {
            session()->setFlashdata("success", "Registration successfully, please login.");
            return redirect()->to("/login");
        } else {
            session()->setFlashdata("error", "Failed to register user, try again later.");
            return redirect()->to("/register");
        }
    }

    // User logout
    public function logout()
    {
        if (session()->has("email")) {
            session()->set([
                "id" => "",
                "name" => "",
                "email" => "",
                "isLoggedIn" => FALSE
            ]);
            session()->destroy();
        }
        return redirect()->to("/");
    }

    // User Profile
    public function profile()
    {
        $data["title"] = "Profile";
        $data["categories"] = $this->categories->getAll();
        $data["profile"] = $this->users->getUserProfile();
        $data["cart"] = $this->carts->getTotalItem();
        $data["address"] = $this->users->getUserAddress();
        return view("profile", $data);
    }

    // Update User Profile process
    public function updateProfile()
    {
        $validation = $this->validate([
            "user_name" => ["label" => "Name", "rules" => "required|min_length[5]", "errors" => [
                "required" => "Please enter your name.",
                "min_length" => "Name must be atleast 5 characters long."
            ]],
            "email" => ["label" => "Email", "rules" => "required|valid_email", "errors" => [
                "required" => "Enter your email.",
                "valid_email" => "Please enter a valid email address.",
            ]]
        ]);

        if (!$validation) return $this->profile();

        $data = [
            "user_name" => $this->request->getVar("user_name"),
            "email" => $this->request->getVar("email"),
        ];

        if ($data["email"] !== session()->email) {
            $check_email = $this->users->checkUser("email", $data["email"]);
            if ($check_email) {
                session()->setFlashdata("error", "The email is already in use by another user.");
                return redirect()->to("/profile");
            }
        }

        $update = $this->users->update(session()->id, $data);
        if ($update) {
            session()->setFlashdata("success", "Profile updated successfully");
        } else {
            session()->setFlashdata("error", "Failed to updating profile, try again later.");
        }
        return redirect()->to("/profile");
    }

    public function formChangePassword()
    {
        $data["title"] = "Change Password";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        return view("change_password", $data);
    }

    // Change password user
    public function changePassword()
    {
        $validation = $this->validate([
            "current_password" => ["label" => "Current Password", "rules" => "required", "errors" => [
                "required" => "Please enter your current password.",
            ]],
            "new_password" => ["label" => "New Password", "rules" => "required|min_length[5]|alpha_numeric", "errors" => [
                "required" => "Enter your new password.",
                "min_length" => "New password must be atleast 5 digits.",
                "alpha_numeric" => "new password must contain alpha numeric"
            ]],
            "confirm_password" => ["label" => "Confirm Password", "rules" => "required|matches[new_password]", "errors" => [
                "required" => "Re-enter your password.",
                "matches" => "Confirm password and password must be same."
            ]],
        ]);

        if (!$validation) return $this->formChangePassword();

        $user_exist = $this->users->checkUser("email", session()->email);
        if ($user_exist) {
            $pass_match = password_verify($this->request->getVar("current_password"), $user_exist->password);
            if ($pass_match) {
                $data = ["password" => password_hash($this->request->getVar("new_password"), PASSWORD_DEFAULT)];
                $update = $this->users->update(session()->id, $data);
                if ($update) {
                    return $this->logout();
                } else {
                    session()->setFlashdata("error", "Failed to change your password, try again later.");
                    return redirect()->to("/profile/change_password");
                }
            } else {
                session()->setFlashdata("error", "Current password has not match.");
                return redirect()->to("/profile/change_password");
            }
        } else {
            session()->setFlashdata("error", "Invalid credentials, please login again.");
            return redirect()->to("/login");
        }
    }

    public function transaction()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-QF29mMsRPIg7o3FWyiRzRByI';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $data["title"] = "Transaction";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        $transactions = $this->transactions->getTransactionWaiting();
        $data["transactions"] = $transactions;

        foreach ($transactions as $transaction) :
            if ($transaction->order_id !== NULL) :
                $status = \Midtrans\Transaction::status($transaction->order_id);
                if ($status->transaction_status === "settlement") :
                    $d = ["order_id" => NULL, "snap_token" => NULL, "payment_deadline" => NULL, "status" => "3"];
                    $this->db->table("transactions")->where("id_transaction", $transaction->id_transaction)->update($d);
                endif;
            endif;
        endforeach;

        return view("transaction", $data);
    }

    public function transactionProcessed()
    {
        $data["title"] = "Transaction";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        $data["transactions"] = $this->transactions->getTransactionProcessed();
        return view("transaction_processed", $data);
    }

    public function transactionCanceled()
    {
        $data["title"] = "Transaction";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        $data["transactions"] = $this->transactions->getTransactionCanceled();
        return view("transaction_canceled", $data);
    }

    public function transactionShipped()
    {
        $data["title"] = "Transaction";
        $data["categories"] = $this->categories->getAll();
        $data["cart"] = $this->carts->getTotalItem();
        $data["transactions"] = $this->transactions->getTransactionShipped();
        return view("transaction_shipped", $data);
    }

    public function transactionDetail($id)
    {
        if (@$id) {
            $data["title"] = "Transaction";
            $data["categories"] = $this->categories->getAll();
            $data["cart"] = $this->carts->getTotalItem();
            $data["transactions"] = $this->transactions->getTransactionDetail($id);
            return view("transaction_detail", $data);
        } else {
            return redirect()->to("/profile/transaction");
        }
    }

    public function addAddress()
    {
        $validation = $this->validate([
            "title" => ["label" => "Name", "rules" => "required", "errors" => [
                "required" => "Please enter your title of address."
            ]],
            "address" => ["label" => "Address", "rules" => "required", "errors" => [
                "required" => "Please enter your address."
            ]],
            "city" => ["label" => "City", "rules" => "required", "errors" => [
                "required" => "Please enter your city."
            ]],
            "province" => ["label" => "Province", "rules" => "required", "errors" => [
                "required" => "Please enter your province."
            ]],
            "postcode" => ["label" => "Postcode", "rules" => "required|numeric", "errors" => [
                "required" => "Please enter your postcode.",
                "numeric" => "Postcode must be a number.",
            ]],
            "phone_number" => ["label" => "Phone Number", "rules" => "required|numeric", "errors" => [
                "required" => "Please enter your phone number.",
                "numeric" => "Phone number must be a number."
            ]],
        ]);

        if (!$validation) return $this->profile();

        $data = [
            "title" => $this->request->getVar("title"),
            "address" => $this->request->getVar("address"),
            "city" => $this->request->getVar("city"),
            "province" => $this->request->getVar("province"),
            "postcode" => $this->request->getVar("postcode"),
            "phone_number" => $this->request->getVar("phone_number"),
            "user_id" => session()->id
        ];

        $this->users->addUserAddress($data);
        session()->setFlashdata("success", "Address has been added.");
        return redirect()->to("/profile");
    }

    public function updateAddress($id)
    {
        $data["title"] = "Edit Address";
        $data["categories"] = $this->categories->getAll();
        $data["profile"] = $this->users->getUserProfile();
        $data["cart"] = $this->carts->getTotalItem();
        $data["address"] = $this->users->getUserAddressById($id);
        return view("address_edit", $data);
    }

    public function deleteAddress($id)
    {
        if ($id) {
            $this->users->removeUserAddress($id);
            session()->setFlashdata("success", "Address has been removed.");
            return redirect()->to("/profile");
        } else {
            return redirect()->to("/profile");
        }
    }

    public function updateAddressProcess()
    {
        $validation = $this->validate([
            "title" => ["label" => "Name", "rules" => "required", "errors" => [
                "required" => "Please enter your title of address."
            ]],
            "address" => ["label" => "Address", "rules" => "required", "errors" => [
                "required" => "Please enter your address."
            ]],
            "city" => ["label" => "City", "rules" => "required", "errors" => [
                "required" => "Please enter your city."
            ]],
            "province" => ["label" => "Province", "rules" => "required", "errors" => [
                "required" => "Please enter your province."
            ]],
            "postcode" => ["label" => "Postcode", "rules" => "required|numeric", "errors" => [
                "required" => "Please enter your postcode.",
                "numeric" => "Postcode must be a number.",
            ]],
            "phone_number" => ["label" => "Phone Number", "rules" => "required|numeric", "errors" => [
                "required" => "Please enter your phone number.",
                "numeric" => "Phone number must be a number."
            ]],
        ]);

        if (!$validation) return $this->updateAddress($this->request->getVar("id_address"));

        $data = [
            "title" => $this->request->getVar("title"),
            "address" => $this->request->getVar("address"),
            "city" => $this->request->getVar("city"),
            "province" => $this->request->getVar("province"),
            "postcode" => $this->request->getVar("postcode"),
            "phone_number" => $this->request->getVar("phone_number")
        ];

        $this->users->updateAddress($this->request->getVar("id_address"), $data);
        session()->setFlashdata("success", "Address has been updated.");
        return redirect()->to("/profile");
    }
}
