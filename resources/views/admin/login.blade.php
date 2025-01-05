<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* General body and background */
        body {
            background: linear-gradient(135deg, #8B5CF6, #6D28D9);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
            font-family: 'Arial', sans-serif;
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

        /* Form title styling */
        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #6D28D9;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Label and input field styling */
        label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #4B5563;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.5rem;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            font-size: 1rem;
        }

        input:focus {
            border-color: #6D28D9;
            outline: none;
        }

        /* Custom button styling */
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #6D28D9;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #4C1D95;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="form-title">Admin Login</h2>

    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.authenticate') }}">
        @csrf
        <!-- Email -->
        <div class="mb-4">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit">Log In</button>
        </div>
    </form>
</div>

</body>
</html>
