<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Parent-Child Relationship Sorting in Laravel
 *
 * This script demonstrates how to sort results based on a parent-child relationship in Laravel's Eloquent.
 * The example focuses on a scenario where categories and subcategories are stored in the same table,
 * and we want to sort them such that parents appear before their children.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch the sorted results.
 *
 * Note:
 * - Modify the table names and column names as per your application's database schema.
 * - This sorting method is useful for hierarchical data structures like categories.
 */

class OrderByParentChildController extends Controller
{
    /**
     * Display a sorted list of categories and subcategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Example query to fetch and sort categories and subcategories
        $categories = DB::table('binfo_catsubcats') // Replace with your actual table name
            ->orderByRaw("CASE WHEN binfo_catsubcats.parent_id = 0 THEN binfo_catsubcats.id ELSE binfo_catsubcats.parent_id END, binfo_catsubcats.parent_id, binfo_catsubcats.id")
            ->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($categories);
    }
}
