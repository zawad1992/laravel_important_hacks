<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Laravel Query Logging Controller
 *
 * This controller demonstrates how to enable query logging in Laravel
 * and retrieve the query log, including the last executed query.
 *
 * Usage:
 * - Place this controller in your Laravel application.
 * - Call the methods provided to enable logging and retrieve the query log.
 * - This can be particularly useful for debugging and performance analysis.
 *
 * Note:
 * - Remember that enabling the query log can increase memory usage, especially with many queries.
 * - It's advisable to use this feature primarily during development or debugging.
 */

class QueryLoggingController extends Controller
{
    /**
     * Enable query logging.
     */
    public function enableQueryLog()
    {
        // Enable the query log on the default database connection
        DB::connection()->enableQueryLog();
    }

    /**
     * Retrieve and display the query log.
     *
     * @return array
     */
    public function getQueryLog()
    {
        // Fetch the query log
        $queries = DB::getQueryLog();

        // Optionally, uncomment to see the last executed query
        // $lastQuery = end($queries);

        // Return the query log (and last query if needed)
        return [
            'queries' => $queries,
            // 'lastQuery' => $lastQuery,
        ];
    }
}
