<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Group;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Show a list of teachers (READ)
    public function index()
    {
        $teachers = Teacher::all(); // Fetch all teachers
        return view('teachers.index', compact('teachers')); // Return a view with data
    }

    // Show the form to create a new teacher (CREATE)
    public function create()
    {
        return view('teachers.create'); // Return a form for creating a new teacher
    }

    // Store the new teacher in the database (CREATE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|string',
            'weekly_hours' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validated['password'] = bcrypt($request->password);

        $teacher = Teacher::create($validated); // Store the validated data and get the created teacher instance
        
        // Log in the teacher after creating
        Auth::guard('teacher')->login($teacher);

        return redirect()->route('admin.dashboard'); // Redirect to the list of teachers
    }

    // Show the form to edit a teacher (UPDATE)
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher')); // Return an edit form with teacher data
    }

    // Update a teacher's data in the database (UPDATE)
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'type' => 'required|string',
            'weekly_hours' => 'required|integer',
        ]);

        $teacher->update($validated); // Update teacher data
        return redirect()->route('teachers.index'); // Redirect to the list of teachers
    }

    // Delete a teacher from the database (DELETE)
    public function destroy(Teacher $teacher)
    {
        $teacher->delete(); // Delete teacher
        return redirect()->route('teachers.index'); // Redirect to the list of teachers
    }

 public function welcome()
    {
        $groups = Group::all(); 
        $courses = Courses::where('teacher_id', Auth::guard('teacher')->id())->with('group')->get();
        return view('teacher.welcome', compact('groups', 'courses')); 
    }
    

public function filterCourses($groupId)
{
    $groups = Group::all();
    $courses = Courses::where('teacher_id', Auth::guard('teacher')->id())
                      ->where('group_id', $groupId)
                      ->with('group')
                      ->get();

    return view('teacher.welcome', compact('groups', 'courses'));
}

public function storeCourse(Request $request)
{
    $validated = $request->validate([
        'subject' => 'required|string',
        'course_name' => 'required|string',
        'date' => 'required|date',
        'type' => 'required|string',
        'description' => 'required|string',
        'group_id' => 'required|exists:groups,id',
    ]);

    $validated['teacher_id'] = Auth::guard('teacher')->id(); // Assign the logged-in teacher

    Courses::create($validated);
    return redirect()->route('teacher.welcome');
}

}
