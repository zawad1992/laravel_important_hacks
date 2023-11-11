<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Custom OrderBy Using CASE Statement in Laravel
 *
 * This script demonstrates how to use a custom 'orderBy' clause with a 'CASE' statement in Laravel's Eloquent.
 * The example focuses on ordering the results of a query based on a sequence of statuses.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch the results.
 *
 * Note:
 * - Modify the table names and column names as per your application's database schema.
 * - This approach is useful for complex sorting requirements that are not straightforward with typical 'orderBy' methods.
 */

class OrderByRawController extends Controller
{
    /**
     * Fetch and order requisitions based on custom status order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Assuming $dataObj is a query builder instance (e.g., Model::query())
        // Initialize $dataObj with your actual query
        $dataObj = DB::table('a_requisitions'); // Replace with your actual query

        // Apply custom orderBy using a CASE statement
        $dataObj = $dataObj->orderByRaw('CASE
                                               WHEN a_requisitions.status = 0 THEN 1
                                               WHEN a_requisitions.status = 1 THEN 2
                                               WHEN a_requisitions.status = 2 THEN 3
                                               WHEN a_requisitions.status = 3 THEN 4
                                               WHEN a_requisitions.status = 4 THEN 5
                                               WHEN a_requisitions.status = 5 THEN 6
                                               WHEN a_requisitions.status = 6 THEN 7
                                            END');

        // Execute the query
        $results = $dataObj->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($results);
    }
}
