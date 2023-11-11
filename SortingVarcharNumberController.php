<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Sorting Varchar Number Strings in Laravel
 *
 * This script demonstrates sorting results in Laravel based on varchar number strings.
 * Normally, when sorting varchar numbers, they are ordered alphabetically, which can lead to 
 * unintuitive results. For example, '10' would come before '2' in an alphabetical order.
 *
 * Example Problem:
 * - Normal ordering: 1, 10, 2, 20, 3 (Alphabetical sorting)
 * - Desired ordering: 1, 2, 3, 10, 20 (Numerical sorting)
 *
 * This script uses a combination of sorting by length and then by the varchar itself
 * to achieve a more natural numerical order.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch sorted results.
 *
 * Note:
 * - Adjust the table and column names according to your application's database schema.
 * - Suitable for varchar fields containing numeric strings that require numerical ordering.
 */

class SortingVarcharNumberController extends Controller
{
    /**
     * Display a list of Student ID sorted by their number strings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Query to fetch and sort credit notes by varchar number strings
        // Sorts first by the length of the varchar, then by the varchar itself
        $pReturn = DB::table('students') // Replace with your actual table name
            ->orderBy(DB::raw('LENGTH(student_id)'))
            ->orderBy('student_id')
            ->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($pReturn);
    }
}
