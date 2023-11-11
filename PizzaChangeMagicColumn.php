<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Pizza Model
 *
 * This model represents a Pizza entity in the application.
 * It extends the Laravel Eloquent Model and modifies the default timestamp column names.
 *
 * In this model, the default 'created_at' and 'updated_at' columns are renamed.
 * - 'created_at' is changed to 'cooked_at' to represent the time when the pizza was cooked.
 * - 'updated_at' is changed to 'reheated_at' to represent the time when the pizza was last reheated.
 *
 * Usage:
 * - Use this model to interact with the corresponding 'pizzas' table in the database.
 * - Ensure that your database table includes 'cooked_at' and 'reheated_at' columns.
 *
 * Note:
 * - This customization is particularly useful when your application's context requires different naming conventions.
 * - Remember to apply the appropriate migrations if you are adjusting an existing database schema.
 */

class PizzaChangeMagicColumn extends Model 
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'cooked_at';
    
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'reheated_at';

    // Additional model properties and methods go here
}

