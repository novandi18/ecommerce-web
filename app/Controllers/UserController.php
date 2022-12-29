<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $db, $users, $categories, $carts;

    public function __construct()
    {
        $this->db = db_connect();
        $this->users = new UserModel();
        $this->categories = new CategoryModel();
        $this->carts = new CartModel();
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
            ]],
            "phone_number" => ["label" => "Phone Number", "rules" => "required|numeric", "errors" => [
                "required" => "Enter your mobile number.",
                "numeric" => "Phone number must be a number."
            ]],
            "address" => ["label" => "Address", "rules" => "required|min_length[5]", "errors" => [
                "required" => "Enter your address.",
                "min_length" => "Address must be atleast 5 characters long."
            ]]
        ]);

        if (!$validation) return $this->profile();

        $data = [
            "user_name" => $this->request->getVar("user_name"),
            "email" => $this->request->getVar("email"),
            "phone_number" => $this->request->getVar("phone_number"),
            "address" => $this->request->getVar("address"),
        ];

        if ($data["email"] !== session()->email) {
            $check_email = $this->users->checkUser("email", $data["email"]);
            if ($check_email) {
                session()->setFlashdata("error", "The email is already in use by another user.");
                return redirect()->to("/profile");
            }
        }

        $check_phone_number = $this->users->checkUserWithoutSession("phone_number", $data["phone_number"]);
        if ($check_phone_number) {
            session()->setFlashdata("error", "The phone number is already in use by another user.");
            return redirect()->to("/profile");
        }

        $update = $this->users->update(session()->id, $data);
        if ($update) {
            session()->setFlashdata("success", "Profile updated successfully");
        } else {
            session()->setFlashdata("error", "Failed to updating profile, try again later.");
        }
        return redirect()->to("/profile");
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

        if (!$validation) return $this->profile();

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
                    return redirect()->to("/profile");
                }
            } else {
                session()->setFlashdata("error", "Current password has not match.");
                return redirect()->to("/profile");
            }
        } else {
            session()->setFlashdata("error", "Invalid credentials, please login again.");
            return redirect()->to("/login");
        }
    }
}
