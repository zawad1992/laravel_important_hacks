<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Sorting Records by Current Date in Laravel
 *
 * This script demonstrates how to sort records in Laravel based on their date in relation to the current date.
 * The query uses `orderByRaw` with a `CASE` statement to prioritize records with dates greater than or equal to today,
 * followed by those with dates in the past.
 *
 * Example Usage:
 * - Place this code in a controller method in your Laravel application.
 * - Call this method from a route to execute the query and fetch sorted results.
 *
 * Note:
 * - Adjust the table name and column name as per your application's database schema.
 * - This sorting method is useful for organizing records based on their timeliness.
 */

class OrderByCurrentDatesController extends Controller
{
    /**
     * Display a list of working days sorted by their proximity to the current date.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Query to fetch and sort working days by their date in relation to today
        $workingDays = DB::table('working_days') // Replace with your actual table name
            ->orderByRaw(
                "CASE
                   WHEN working_days.dates >= DATE(NOW()) THEN 1
                   WHEN working_days.dates < DATE(NOW()) THEN 2
                 END")
            ->orderBy('dates', 'ASC')
            ->get();

        // Return the results (Replace with your actual response handling)
        return response()->json($workingDays);
    }
}
