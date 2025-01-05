<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    // Show the sign-up form for teachers
    public function showSignUpForm()
    {
        return view('auth.signup'); // Create the view for sign-up form
    }

    // Handle the sign-up form submission
    public function signUp(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:permanent,part-time',
            'weekly_hours' => 'required|integer|min:1',
            'password' => 'required|string|min:6|confirmed', // Confirm password field in the form
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the new teacher record
        Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'weekly_hours' => $request->weekly_hours,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('signin')->with('success', 'Teacher account created. Please log in.');
    }
}
