<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <style>
        /* General body and background */
        body {
            background: linear-gradient(135deg, #4F46E5, #3B82F6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
        }

        /* Form container styling */
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        /* Logo styling */
        .logo {
            font-family: 'Shrikhand', cursive;
            font-size: 28px;
            font-weight: 700;
            color: #4F46E5;
            text-decoration: none;
        }

        /* Admin button styling */
        .top-right-btn {
            background-color: white;
            color: #4F46E5;
            border: 2px solid #4F46E5;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .top-right-btn:hover {
            background-color: #4F46E5;
            color: white;
        }

        /* Header with logo and admin button */
        header {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Form title styling */
        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Custom button styling */
        .custom-btn {
            background: #4F46E5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            transition: background-color 0.2s ease-in-out;
            width: 100%;
        }

        .custom-btn:hover {
            background: #3B82F6;
        }

        /* Link styling */
        .signup-link {
            color: #3B82F6;
            text-decoration: underline;
        }

        /* Black text for extra messages */
        .signup-text {
            font-size: 0.875rem;
            color: black;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>



<div class="form-container">
    <h2 class="form-title"> Sign Up</h2>

    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('signup') }}" method="POST">
        @csrf

        <!-- First Name -->
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="first_name" name="first_name" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('first_name') }}" required>
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('last_name') }}" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('email') }}" required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone (Optional)</label>
            <input type="text" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('phone') }}">
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select id="type" name="type" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                <option value="permanent" {{ old('type') == 'permanent' ? 'selected' : '' }}>Permanent</option>
                <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
            </select>
        </div>

        <!-- Weekly Hours -->
        <div class="mb-4">
            <label for="weekly_hours" class="block text-sm font-medium text-gray-700">Weekly Hours</label>
            <input type="number" id="weekly_hours" name="weekly_hours" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('weekly_hours') }}" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
        </div>
        <!-- Already have an account -->
        <p class="signup-text">
            Already have an account? <a href="http://127.0.0.1:8000/signin" class="signup-link">Log In</a>
        </p>
        <br>
        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="custom-btn">Sign Up</button>
        </div>
    </form>
</div>

</body>
</html>
