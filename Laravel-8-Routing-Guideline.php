<?php

/**
 * Laravel 8 Routing Guide
 *
 * This PHP file provides guidance on defining routes in Laravel 8,
 * which introduces changes to the way controllers are referenced in routes.
 *
 * In Laravel 8, routes do not have an automatic namespace prefix of 'App\Http\Controllers'.
 * This file explains two methods to define routes with controller classes.
 */

/**********************************
 * Method 1: Using Fully Qualified Class Names
 *
 * In your routes files (typically web.php or api.php), you can directly use the Fully Qualified Class Name.
 * This method requires explicitly importing the controller at the top of the routes file.
 *
 * Example:
 **********************************/


use App\Http\Controllers\UserController;

// Using PHP 8's syntax for specifying controller methods
Route::get('/users', [UserController::class, 'index']);

// Alternatively, using a string to specify the controller and method
Route::get('/users', 'App\Http\Controllers\UserController@index');



/*********************************
 * Method 2: Applying Namespace Prefixing
 *
 * If you prefer the Laravel 7 and earlier style of route definitions, you can add namespace prefixing
 * in the RouteServiceProvider. This allows you to define routes using just the controller's short name.
 *
 * In App\Providers\RouteServiceProvider, add a namespace prefix to your route groups:
 *********************************/


public function boot()
{
    // ...

    Route::prefix('api')
        ->middleware('api')
        ->namespace('App\Http\Controllers') // Add namespace prefix here
        ->group(base_path('routes/api.php'));

    // Other route groups...
}


/**
 * After applying the namespace prefixing, you can define routes as follows in your routes files:
 */


Route::get('/users', 'UserController@index');


/**
 * Additional Notes:
 * - Choose the method that best fits your preference and project style.
 * - Fully Qualified Class Names are the recommended approach in Laravel 8.
 * - Be consistent with the method you choose throughout your application.
 *
 * This file serves as a guide for developers on handling routing in Laravel 8.
 */
