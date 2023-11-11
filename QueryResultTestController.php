<?php

namespace App\Http\Controllers;

use App\Model; // Replace with your actual model
use Illuminate\Http\Request;

/**
 * Query Result Testing Controller
 *
 * This controller provides examples of how to correctly check if a Laravel query returns results.
 * It demonstrates various methods to determine if the result of a query is empty or not.
 *
 * Key Points:
 * - The Laravel query builder's `get()` method always returns a Collection, even when no records are found.
 * - Simply using `if($result)` is not sufficient to check for an empty result because an empty Collection is still an object.
 * - This code illustrates different methods to accurately check for the presence of data in query results.
 *
 * Methods Demonstrated:
 * - Checking if the first element exists.
 * - Using `isEmpty()` to check if the Collection is empty.
 * - Using `count()` on the Collection.
 * - Using PHP's `count()` function.
 * - Optionally, using `first()` instead of `get()` for single record queries.
 *
 * Usage:
 * - Place this controller in your Laravel application.
 * - Call these methods from routes to understand how query result checking works.
 */
class QueryResultTestController extends Controller
{
    /**
     * Demonstrates various ways to check if query results are empty.
     *
     * @return void
     */
    public function index()
    {
        // Example query
        $result = Model::where('column', 'value')->get();

        // Method 1: Check if the first element exists
        if ($result->first()) {
            echo "Result is not empty (first element exists).";
        } else {
            echo "Result is empty (no first element).";
        }

        // Method 2: Check using isEmpty()
        if (!$result->isEmpty()) {
            echo "Result is not empty (using isEmpty()).";
        } else {
            echo "Result is empty (using isEmpty()).";
        }

        // Method 3: Check using count() on Collection
        if ($result->count()) {
            echo "Result is not empty (using Collection's count()).";
        } else {
            echo "Result is empty (using Collection's count()).";
        }

        // Method 4: Check using PHP's count() function
        if (count($result)) {
            echo "Result is not empty (using PHP's count()).";
        } else {
            echo "Result is empty (using PHP's count()).";
        }

        // Bonus: Using first() for single record queries
        /*
        $singleResult = Model::where('column', 'value')->first();
        if ($singleResult) {
            echo "Single result found.";
        } else {
            echo "No result found.";
        }
        */
    }
}
