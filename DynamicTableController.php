<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Dynamic Table Creation Controller
 *
 * This controller demonstrates how to dynamically create a database table in Laravel.
 * The table is created with a specific ID in its name, making it unique.
 *
 * Usage:
 * - Place this method inside an appropriate controller in your Laravel application.
 * - Call this method from a route or another part of your application where you need to dynamically create a table.
 * - Ensure that the database connection 'mysql' is correctly configured in your `config/database.php`.
 *
 * Example:
 * - To create a table named 'mytable_123', pass 123 as the ID to the method where this code resides.
 *
 * Note:
 * - Dynamic table creation is a rare use case in typical applications and should be used with caution.
 * - Ensure that the creation of multiple tables doesn't adversely affect the performance and maintainability of your application.
 * - Remember to manage these tables appropriately, including their migration and deletion.
 */

class DynamicTableController extends Controller
{
    /**
     * Create a table dynamically with a given ID.
     *
     * @param int $id The unique identifier to append to the table name.
     * @return \Illuminate\Http\Response
     */
    public function createTable($id)
    {
        // Define the table name
        $tableName = 'mytable_' . $id;

        // Check if the table already exists
        if (!Schema::connection('mysql')->hasTable($tableName)) {
            // Create the table
            Schema::connection('mysql')->create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
            });

            return response()->json(['message' => "Table {$tableName} created successfully"], 200);
        }

        return response()->json(['message' => "Table {$tableName} already exists"], 400);
    }
}
