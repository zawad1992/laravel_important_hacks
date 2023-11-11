<?php

/********************************
* Instructions for Use:
* Save this content in appropriate PHP files within your Laravel application.
* Place the School and Student models in the app/Models directory.
* Save the SchoolStudentsController in the app/Http/Controllers directory.
* Create a route in your routes/web.php file that points to the index method of SchoolStudentsController.
* Replace 'whateverField' and 'whateverProperty' with the actual field or property names you want to sort by.
* Adjust the logic and response handling as needed to fit your specific use case.
*********************************/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * School Model
 *
 * Represents a School entity with a one-to-many relationship to Students.
 */
class School extends Model
{
    /**
     * Get the students associated with the school.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

/**
 * Student Model
 *
 * Represents a Student entity belonging to a School.
 */
class Student extends Model
{
    /**
     * Get the school that the student belongs to.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;

/**
 * SchoolStudentsController
 *
 * Demonstrates different methods to order associated data (students) of a school.
 */
class SchoolStudentsController extends Controller
{
    /**
     * Display a list of students of a school ordered by a specific field.
     *
     * @param int $schoolId
     * @return \Illuminate\Http\Response
     */
    public function index($schoolId)
    {
        // Eager loading students with ordering
        $schoolWithOrderedStudents = School::with(['students' => function ($q) {
            $q->orderBy('whateverField', 'asc'); // Replace 'whateverField' with actual field name
        }])->find($schoolId);

        // Lazy loading students with ordering
        $school = School::find($schoolId);
        $school->load(['students' => function ($q) {
            $q->orderBy('whateverField', 'desc'); // Replace 'whateverField' with actual field name
        }]);

        // Sorting on the collection
        // Ascending
        $school->students->sortBy('whateverProperty'); // Replace 'whateverProperty' with actual property name
        // Descending
        $school->students->sortByDesc('whateverProperty'); // Replace 'whateverProperty' with actual property name

        // Querying students directly
        $orderedStudents = Student::whereHas('school', function ($q) use ($schoolId) {
            $q->where('id', $schoolId);
        })->orderBy('whateverField')->get(); // Replace 'whateverField' with actual field name

        // Return the results (Replace with your actual response handling)
        return response()->json([
            'eager_loading' => $schoolWithOrderedStudents,
            'lazy_loading' => $school,
            'direct_query' => $orderedStudents
        ]);
    }
}
