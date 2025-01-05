<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Teacher;
use App\Models\Group;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    // Show a list of courses (READ)
    public function index()
    {
        $courses = Courses::with(['teacher', 'group'])->get(); // Fetch all courses with their teacher and group
        return view('courses.index', compact('courses')); // Return a view with data
    }

    // Show the form to create a new course (CREATE)
    public function create()
    {
        $teachers = Teacher::all(); // Get all teachers
        $groups = Group::all(); // Get all groups
        return view('courses.create', compact('teachers', 'groups')); // Return a form for creating a new course
    }

    // Store the new course in the database (CREATE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'type' => 'required|string',
            'description' => 'required|string',
            'subject' => 'required|string',
            'course_name' => 'required|string',
        ]);

        Courses::create($validated); // Store the validated data
        return redirect()->route('admin.dashboard'); // Redirect to the list of courses
    }

    // Show the form to edit a course (UPDATE)
    public function edit(Courses $course)
    {
        $teachers = Teacher::all(); // Get all teachers
        $groups = Group::all(); // Get all groups
        return view('courses.edit', compact('course', 'teachers', 'groups')); // Return an edit form with course data
    }

    // Update a course's data in the database (UPDATE)
    public function update(Request $request, Courses $course)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'type' => 'required|string',
            'description' => 'required|string',
            'subject' => 'required|string',
            'course_name' => 'required|string',
        ]);

        $course->update($validated); // Update course data
        return redirect()->route('courses.index'); // Redirect to the list of courses
    }

    // Delete a course from the database (DELETE)
    public function destroy(Courses $course)
    {
        $course->delete(); // Delete course
        return redirect()->route('courses.index'); // Redirect to the list of courses
    }
}
