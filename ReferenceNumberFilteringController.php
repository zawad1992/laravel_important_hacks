<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Comment;

/**
 * ReferenceNumberFilteringController
 *
 * This controller demonstrates different methods for filtering data based on reference numbers.
 * It showcases how to use subqueries and the 'whereIn' clause in Laravel's Eloquent.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch filtered results.
 *
 * Note:
 * - Replace 'Comment' with your actual model and adjust table/column names as per your database schema.
 */

class ReferenceNumberFilteringController extends Controller
{
    /**
     * Display data filtered by reference numbers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Define your condition for the comment
        $commentWhere = '...'; // Replace with your actual condition

        // Method 1: Using CONCAT and implode
        $commentsRefData = Comment::select(DB::raw("CONCAT(CHAR(39), reference_number, CHAR(39)) AS reference_number"))
            ->whereRaw($commentWhere)
            ->pluck('reference_number', 'reference_number')
            ->toArray();

        $commentsRefDataStr = implode(',', $commentsRefData);
        $dataObj = DB::table('reference') // Replace with your actual query
            ->whereRaw("reference.reference_number IN ($commentsRefDataStr)");

        // Method 2: Using subquery in whereRaw
        // Uncomment the following line to use a subquery directly in whereRaw
        // $dataObj = DB::table('reference')->whereRaw("reference.reference_number IN (SELECT comments.reference_number FROM comments WHERE $commentWhere)");

        // Method 3: Using whereIn with a simple array of reference numbers
        $commentsRefDataSimple = Comment::select('reference_number')
            ->whereRaw($commentWhere)
            ->pluck('reference_number', 'reference_number');
        $dataObj = DB::table('reference') // Replace with your actual query
            ->whereIn('reference.reference_number', $commentsRefDataSimple);

        // Execute the query and fetch results
        $results = $dataObj->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($results);
    }
}
