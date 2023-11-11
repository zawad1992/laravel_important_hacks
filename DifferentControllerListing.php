<?php

use Illuminate\Support\Facades\Route;

/**
 * Controller Listing in Laravel
 *
 * This script demonstrates different methods to retrieve a list of controllers used in a Laravel application.
 * It iterates over all registered routes and extracts the associated controllers.
 *
 * Usage:
 * - Place this script in a suitable location within your Laravel application.
 * - This can be part of a route, command, or controller method, depending on your needs.
 *
 * Note:
 * - Each section of the code demonstrates a different approach to listing controllers.
 * - Remember to modify the script as needed to fit the specific requirements of your application.
 */

// Method 1: Listing all controllers
$controllers = [];
foreach (Route::getRoutes()->getRoutes() as $route) {
    $action = $route->getAction();
    if (array_key_exists('controller', $action)) {
        $controllers[] = $action['controller'];
    }
}
// Output or process $controllers as needed

// Method 2: Listing specific controllers (excluding methods)
$specificControllers = [];
foreach (Route::getRoutes()->getRoutes() as $route) {
    $action = $route->getAction();
    if (array_key_exists('controller', $action)) {
        $controllerName = substr($action['controller'], 0, strpos($action['controller'], "@"));
        $specificControllers[$controllerName] = $controllerName;
    }
}
// Output or process $specificControllers as needed

// Method 3: Removing directories using str_replace
$controllersWithoutDirectories = [];
foreach (Route::getRoutes()->getRoutes() as $route) {
    $action = $route->getAction();
    if (array_key_exists('controller', $action)) {
        $controllerName = substr($action['controller'], 0, strpos($action['controller'], "@"));
        $controllerName = str_replace(['App\\Http\\Controllers\\', 'Auth\\'], '', $controllerName);
        if (!empty($controllerName)) {
            $controllersWithoutDirectories[$controllerName] = $controllerName;
        }
    }
}
// Output or process $controllersWithoutDirectories as needed

// Method 4: Removing directories using explode (More Dynamic)
$dynamicControllersList = [];
foreach (Route::getRoutes()->getRoutes() as $route) {
    $action = $route->getAction();
    if (array_key_exists('controller', $action)) {
        $controllerName = substr($action['controller'], 0, strpos($action['controller'], "@"));
        $controllerArr = explode('\\', $controllerName);
        $controllerName = end($controllerArr);
        if (!empty($controllerName)) {
            $dynamicControllersList[$controllerName] = $controllerName;
        }
    }
}
// Output or process $dynamicControllersList as needed
