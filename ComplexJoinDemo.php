<?php

/**
 * Complex Join Query in Laravel
 * 
 * This script demonstrates how to perform a complex join operation using Laravel's query builder.
 * The join operation links the 'users' table with the 'transfers' table based on user IDs.
 * It retrieves the first name, last name of users along with the transfer amount and date.
 * 
 * Usage:
 * - Place this script in a suitable route or controller method in your Laravel application.
 * - Ensure that the 'users' and 'transfers' tables exist in your database and have the necessary columns.
 * - Adjust the table names and column names as per your database schema.
 *
 * Note:
 * - This script is ideal for demonstrating complex joins in a Laravel application.
 * - It is meant for educational purposes and should be adapted to fit specific use cases.
 */

use Illuminate\Support\Facades\DB;

// Performing a complex join query using Laravel's query builder
$transfer = DB::table('users')
    ->join('transfers', function($join) {
        $join->on('users.id', '=', 'transfers.from_user_id');
    })
    ->select('users.first_name', 'users.last_name', 'transfers.amount', 'transfers.date')
    ->get();

// Output the results (for testing purposes, remove in production)
dd($transfer);
