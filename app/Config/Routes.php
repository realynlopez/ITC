<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('products', 'ProductController::getIndex');
$routes->get('products/(:any)', 'ProductController::find/$1');

// $routes->get('/users/profile', function(){
//     return "i am user profile";

// });

$routes->group('users', static function ($routes) {

   $routes->get('order', function(){
       return "i am user order";

   });
   $routes->get('profile', function(){
       return "i am user profile";

   });


    // $routes->get('profile', 'ProductController::profile');
    // $routes->get('order', 'ProductController::order');

});
