<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for unique look */
        body {
            background: linear-gradient(135deg, #4F46E5, #3B82F6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .logo {
            font-family: 'Shrikhand', cursive;
            font-size: 28px;
            font-weight: 700;
            color: #4F46E5; /* Single color */
            text-decoration: none;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1.5rem;
            text-align: center;
        }

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

        .signup-link {
            color: #3B82F6;
            text-decoration: underline;
        }

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

        header {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signup-text {
            font-size: 0.875rem;
            color: black;
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

<header>
    <a href="#" class="logo">
        ClassLog
    </a>
    <a href="{{ route('admin.login') }}" class="top-right-btn">Admin</a>
</header>

<div class="form-container">
    <h2 class="form-title">Sign In</h2>

    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('signin') }}" method="POST">
        @csrf

        <!-- Email Input -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded" value="{{ old('email') }}" required>
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="custom-btn">Sign In</button>
        </div>
    </form>

    <p class="signup-text">
        Don't have an account? <a href="http://127.0.0.1:8000/signup" class="signup-link">Sign Up</a>
    </p>
</div>

</body>
</html>
