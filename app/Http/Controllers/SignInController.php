<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    // Show the sign-in form
    public function showSignInForm()
    {
        return view('auth.signin'); // Create the view for sign-in form
    }

    // Handle the sign-in logic
    public function signIn(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if the email belongs to an admin or a teacher
        if (strpos($request->email, '@admin.com') !== false) {
            // Admin login
            $admin = Admin::where('email', $request->email)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::login($admin);
                return redirect()->route('admin.teachers'); // Redirect to admin dashboard
            }

        } else {
            $teacher = Teacher::where('email', $request->email)->first();

            if ($teacher && Hash::check($request->password, $teacher->password)) {
                Auth::login($teacher);
                return redirect()->route('teacher.welcome'); 
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}
