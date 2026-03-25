<link rel="stylesheet" href="/styles.css">

<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Routes;
use App\Controllers;

$router = new Routes\Router();

$router->register('/', [Controllers\HomeController::class, 'index'])
     ->register('/about', [Controllers\AboutController::class, 'index'])
     ->register('/about/contact', [Controllers\AboutController::class, 'contact']);

try {
    echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (Routes\RouteNotFoundException $e) {    
    echo $e->getMessage();
}

