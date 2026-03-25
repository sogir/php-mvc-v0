<link rel="stylesheet" href="/styles.css">

<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Router;
use App\RouteNotFoundException;

$router = new Router();

$router->register('/', function() {
    return "Homepage!";
})
->register('/about', function() {
    return "About Page!";
});


try {
    echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (RouteNotFoundException $e) {    
    echo "BEEP BOOP! ALARM! That ride does not exist!";
}

