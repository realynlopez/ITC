<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppRoutes extends BaseConfig
{
    public $defaultNamespace = 'App\Controllers';

    public function __construct()
    {
        $routes = service('routes');
        $routes->setAutoRoute(true);
        // Home Page (Product Listing)
        $routes->get('/', 'Home::index');

        // User Registration
        $routes->get('/register', 'UserController::register');
        $routes->post('/register', 'UserController::register'); // Handle form submission

        // User Login
        $routes->get('/login', 'UserController::login');
        $routes->post('/login', 'UserController::login'); // Handle form submission

        $routes->group('admin', ['filter' => 'admin_auth'], function ($routes) {
            // Admin Dashboard
            $routes->get('/', 'AdminController::dashboard');

            // Admin Product Management
            $routes->get('products', 'AdminController::products'); // Display products
            $routes->get('products/add', 'AdminController::addProduct'); // Add product form
            $routes->post('products/add', 'AdminController::saveProduct'); // Handle product creation
            $routes->get('products/edit/(:num)', 'AdminController::editProduct/$1'); // Edit product form
            $routes->post('products/edit/(:num)', 'AdminController::updateProduct/$1'); // Handle product update
            $routes->get('products/delete/(:num)', 'AdminController::deleteProduct/$1'); // Delete product

            // Other admin routes...
        });

        // User Profile (if applicable)
        $routes->get('profile', 'ProfileController::index');

        // Enable auto-routing for any remaining controllers and methods
        $routes->setAutoRoute(true);
    }
}
