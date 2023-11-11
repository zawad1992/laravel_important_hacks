<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Multiple Conditions on Join Example
 *
 * This script demonstrates how to use multiple conditions in a 'leftJoin' in Laravel's query builder.
 * The example focuses on a scenario where we join 'rooms' and 'bookings' tables to find rooms that
 * are not booked within a specific date range.
 *
 * Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch the results.
 *
 * Note:
 * - Modify the table names, column names, and date range as per your application's database schema.
 * - Ensure that the 'rooms' and 'bookings' tables exist in your database with the appropriate structure.
 */

class MultipleConditionOnJoinController extends Controller
{
    /**
     * Fetch rooms not booked within a specific date range.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Define the date range for the query
        $startDate = '2012-05-01';
        $endDate = '2012-05-10';

        // Execute the query with multiple conditions on the join
        $results = DB::table('rooms')
            ->distinct()
            ->leftJoin('bookings', function($join) use ($startDate, $endDate) {
                $join->on('rooms.id', '=', 'bookings.room_type_id');
                $join->on('arrival', '>=', DB::raw("'{$startDate}'"));
                $join->on('arrival', '<=', DB::raw("'{$endDate}'"));
                $join->on('departure', '>=', DB::raw("'{$startDate}'"));
                $join->on('departure', '<=', DB::raw("'{$endDate}'"));
            })
            ->whereNull('bookings.room_type_id')
            ->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($results);
    }
}
