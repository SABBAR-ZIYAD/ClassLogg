<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Group;
use App\Models\Courses;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show a list of admins (READ)
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index', compact('admins'));
    }

    // Show the form to create a new admin (CREATE)
    public function create()
    {
        return view('admins.create');
    }

    // Store the new admin in the database (CREATE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admins.index');
    }

    // Show the form to edit an admin (UPDATE)
    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    // Update an admin's data in the database (UPDATE)
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $admin->password,
        ]);

        return redirect()->route('admins.index');
    }

    // Delete an admin from the database (DELETE)
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index');
    }

    // Show Admin Login Page
    public function showLoginPage()
    {
        return view('admin.login');
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show Admin Dashboard with Teachers, Courses, and Groups
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Fetch counts
    $teachersCount = Teacher::count();
    $coursesCount = Courses::count();
    $groupsCount = Group::count();

        // Fetch all teachers, courses, and groups
        $teachers = Teacher::all();
        $courses = Courses::with(['teacher', 'group'])->get();
        $groups = Group::all();

        return view('admin.dashboard', compact('teachers', 'courses', 'groups', 'teachersCount', 'coursesCount', 'groupsCount'));
    }

    // Handle Admin Logout
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    // Show Teachers
    public function showTeachers()
    {
        $teachers = Teacher::all(); 
        return view('admin.teachers.index', compact('teachers'));
    }

    // Show Courses
    public function showCourses()
    {
        $courses = Courses::with(['teacher', 'group'])->get(); 
        return view('admin.courses.index', compact('courses'));
    }

    // Show Groups
    public function showGroups()
    {
        $groups = Group::all();
        return view('admin.groups.index', compact('groups')); 
    }

    // Store a new teacher
    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:permanent,part-time',
            'weekly_hours' => 'required|integer',
        ]);
    
        Teacher::create($validated);
    
        return redirect()->route('admin.dashboard');
    }
    // Store a new course
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:lesson,practice',
            'description' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'group_id' => 'required|exists:groups,id',
            'signature' => 'nullable|string|max:255',
        ]);
    
        Courses::create($validated);
    
        return redirect()->route('admin.dashboard');
    }

    // Store a new group
    public function storeGroup(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'level' => 'required|string|max:50',
    ]);

    Group::create($validated);

    return redirect()->route('admin.dashboard');
}
    public function destroyTeacher($id)
{
    Teacher::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard');
}

public function destroyCourse($id)
{
    Courses::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard');
}

public function destroyGroup($id)
{
    Group::findOrFail($id)->delete();
    return redirect()->route('admin.dashboard');
}


}
