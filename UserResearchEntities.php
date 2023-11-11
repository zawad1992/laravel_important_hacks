<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * UserResearchEntities.php
 *
 * This file contains the User and Research models, along with the ResearchController.
 * It demonstrates the relationship between users and their research data, 
 * and provides a controller for handling research data.
 *
 * Note: In a typical Laravel application, it's recommended to separate models and controllers
 * into different files following the MVC pattern for better maintainability and clarity.
 */

/**
 * User Model
 *
 * Represents a User entity with a one-to-many relationship to Research.
 */
class User extends Model
{
    public function research()
    {
        return $this->hasMany(Research::class);
    }
}

/**
 * Research Model
 *
 * Represents a Research entity belonging to a User.
 */
class Research extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

/**
 * Research Controller
 *
 * Handles the retrieval of research data for users.
 */
class ResearchController extends Controller
{
    public function index()
    {
        $researchs = Research::all(); // Retrieve all research entries
        return view('consument.research.index', compact('researchs'));
    }
}

