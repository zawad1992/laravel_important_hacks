<?php

/**
 * Advanced Where Query in Laravel
 * 
 * This script demonstrates the use of advanced 'where' clauses using Laravel's Eloquent.
 * It showcases how to chain multiple 'where' conditions, including a nested condition with 'orWhere'.
 * The query is performed on a model named 'CabRes'.
 * 
 * Usage:
 * - Place this script in an appropriate location within your Laravel application, like a controller method.
 * - Make sure the 'CabRes' model exists and corresponds to your database schema.
 * - Adjust the model name, field names, and conditions as per your application's requirements.
 *
 * Note:
 * - This script is ideal for demonstrating complex conditional queries in a Laravel application.
 * - The query is for illustrative purposes and should be modified to fit specific use cases.
 */

use App\Models\CabRes; // Replace with the correct namespace if different

// Performing an advanced where query using Laravel's Eloquent
$result = CabRes::where('m_Id', 46)
    ->where('t_Id', 2)
    ->where(function($q) {
        $q->where('Cab', 2)
          ->orWhere('Cab', 4);
    })
    ->get();

// Output the results (for testing purposes, remove in production)
dd($result);
