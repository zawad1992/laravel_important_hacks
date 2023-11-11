<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Dynamic Model
 *
 * This model is designed to interact dynamically with various database tables.
 * It allows changing the table it interacts with on the fly, making it suitable
 * for scenarios where the same model structure is applicable to multiple tables.
 *
 * Usage:
 * - Use `setTable` method to change the table name dynamically before performing any query.
 * - Remember to define the table structure in a way that is compatible across different tables.
 */
class Dynamic extends Model
{
    protected $table = 'units'; // Default table, can be changed dynamically

    // Uncomment and modify this if you need specific fields to be mass assignable
    // protected $fillable = ['name', 'description', 'status', 'created_by', 'modified_by', 'ip'];

    /**
     * Set the table name dynamically for the model.
     *
     * @param string $table The table name.
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}

namespace App\Http\Controllers;

use App\Dynamic;
use Illuminate\Http\Request;

/**
 * Dynamic Controller
 *
 * This controller demonstrates how to use the Dynamic model to interact with various tables.
 * It shows how to change the table name of the Dynamic model and perform queries.
 *
 * Example:
 * - The `index` method changes the Dynamic model's table to 'products' and fetches data.
 *
 * Note:
 * - Ensure that the tables you switch to have a compatible structure.
 */
class DynamicController extends Controller
{
    protected $dynamicModelName;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->dynamicModelName = new Dynamic;
        parent::__construct();
    }

    /**
     * Display a listing of the resource from a dynamic table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Change the table to 'products'
        $this->dynamicModelName->setTable('products');

        // Fetch data from the dynamic table
        $allDynamicData = $this->dynamicModelName
                            ->select('id', 'name')
                            ->where('status', 'Active')
                            ->pluck('name', 'id')
                            ->toArray();

        // For demonstration purposes, print the result (replace with proper response in production)
        echo '<pre>';
        print_r($allDynamicData);
        echo '</pre>';
        exit;
    }
}
