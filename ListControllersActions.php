<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class ListControllersActions
{
    /**
     * Handle an incoming request.
     * 
     * This middleware is designed to list all controllers and their actions, as well as identify the current controller and action.
     * It can be applied to routes to aid in debugging or logging controller usage.
     *
     * Steps to Use this Middleware:
     * 1. Create this middleware using `php artisan make:middleware ListControllersActions`.
     * 2. Add the code below to the generated middleware file in `app/Http/Middleware/ListControllersActions.php`.
     * 3. Register this middleware in `app/Http/Kernel.php` under `$routeMiddleware`.
     *    Example: `'list.controllers.actions' => \App\Http\Middleware\ListControllersActions::class,`
     * 4. Apply to routes in `routes/web.php` or `routes/api.php` using 
     *    `->middleware('list.controllers.actions')` or within a route group.
     *
     * Customization:
     * - Modify this middleware to log this information, pass it to views, or other parts of the application as needed.
     * - Ensure to test the middleware to verify correct functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the current action being called
        $action = app('request')->route()->getAction();   
        
        // Extract the current controller and action names
        if (!empty($action['controller'])) {
            $controller = class_basename($action['controller']) ?? 'HomeController@index';
            list($controller, $action) = explode('@', $controller);
        } else {
            $controller = "HomeController"; // You can put any default controller as your needs
            $action = "index"; // You can put any default index as your needs
        }  
    
        // Retrieve all controllers and their actions
        $allControllers = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $allControllers[] = str_replace('App\Http\Controllers\\', '', $action['controller']);
            }
        }

        // Continue the request
        return $next($request);
    }
}
