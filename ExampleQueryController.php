<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Closure Use Example in Laravel Query
 *
 * This script demonstrates the use of the 'use' keyword to pass variables from the parent scope
 * into a closure within a Laravel query. This is particularly useful in building dynamic queries
 * based on certain conditions or variables.
 *
 * Usage:
 * - Place this code in a suitable controller method in your Laravel application.
 * - Call this method from a route to execute the query.
 *
 * Note:
 * - Modify the table name and column names as per your database schema.
 * - Ensure the database connection is correctly configured in Laravel's `config/database.php`.
 */

class ExampleQueryController extends Controller
{
    /**
     * Execute a query with a closure using variables from the parent scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Example variable from the parent scope
        $activated = true;

        // Query using a closure and the 'use' keyword
        $users = DB::table('users')->where(function ($query) use ($activated) {
            $query->where('activated', '=', $activated);
        })->get();

        // Return the results (Replace this with your actual response handling)
        return response()->json($users);
    }
}
