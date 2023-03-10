<?php

namespace Config;

use App\Models\CartModel;
use App\Models\CategoryModel;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    $categories = new CategoryModel();
    $carts = new CartModel();
    $data["title"] = "Page Not Found";
    $data["categories"] = $categories->getAll();
    $data["cart"] = $carts->getTotalItem();
    $data["results"] = $carts->getCartUser();
    return view("404", $data);
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Home
$routes->get("/", "HomeController::index");

// Users
// --- Authentication ---
$routes->get("/login", "UserController::login");
$routes->get("/register", "UserController::register");
$routes->get("/logout", "UserController::logout");
$routes->post("/login", "UserController::loginProcess");
$routes->post("/register", "UserController::registerProcess");

// --- Profile ---
$routes->get("/profile", "UserController::profile", ["filter" => "authFilter"]);
$routes->get("/profile/change_password", "UserController::formChangePassword", ["filter" => "authFilter"]);
$routes->get("/profile/address/(:num)/edit", "UserController::updateAddress/$1", ["filter" => "authFilter"]);
$routes->get("/profile/address/(:num)/delete", "UserController::deleteAddress/$1", ["filter" => "authFilter"]);
$routes->post("/profile/address/new", "UserController::addAddress", ["filter" => "authFilter"]);
$routes->post("/profile/address/edit", "UserController::updateAddressProcess", ["filter" => "authFilter"]);
$routes->post("/profile", "UserController::updateProfile", ["filter" => "authFilter"]);
$routes->post("/profile/change_password", "UserController::changePassword", ["filter" => "authFilter"]);

// --- Shop ---
$routes->get("/shop", "ProductController::shop");
$routes->get("/shop/search", "ProductController::productSearch");
$routes->get("/shop/(:any)/(:any)", "ProductController::productDetail/$1/$2");
$routes->get("/shop/(:any)", "ProductController::shop/$1");
$routes->post("/shop/search", "ProductController::productSearchProcess");

// --- Cart ---
$routes->get("/cart", "CartController::cart", ["filter" => "authFilter"]);
$routes->get("/cart/delete/(:num)", "CartController::deleteFromCart/$1", ["filter" => "authFilter"]);
$routes->post("/cart/add", "CartController::addToCart", ["filter" => "authFilter"]);
$routes->post("/cart/checkout", "CartController::cartToCheckout", ["filter" => "authFilter"]);

// --- Checkout ---
$routes->get("/checkout", "TransactionController::checkout", ["filter" => "authFilter"]);
$routes->post("/checkout", "TransactionController::checkoutProcess", ["filter" => "authFilter"]);

// --- Transaction ---
$routes->get("/profile/transaction", "UserController::transaction", ["filter" => "authFilter"]);
$routes->get("/profile/transaction/canceled", "UserController::transactionCanceled", ["filter" => "authFilter"]);
$routes->get("/profile/transaction/processed", "UserController::transactionProcessed", ["filter" => "authFilter"]);
$routes->get("/profile/transaction/shipped", "UserController::transactionShipped", ["filter" => "authFilter"]);
$routes->get("/profile/transaction/detail/(:num)", "UserController::transactionDetail/$1", ["filter" => "authFilter"]);
$routes->post("/profile/transaction/buy", "TransactionController::buy", ["filter" => "authFilter"]);
$routes->post("/profile/transaction/continuepay", "TransactionController::continuePay", ["filter" => "authFilter"]);
$routes->post("/profile/transaction/arrived", "TransactionController::arrived", ["filter" => "authFilter"]);
$routes->post("/profile/transaction/cancel", "TransactionController::cancelOrder", ["filter" => "authFilter"]);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
