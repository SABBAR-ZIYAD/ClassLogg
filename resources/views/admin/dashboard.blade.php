<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #4A4E69;
            margin: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard-section {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .dashboard-section h2 {
            margin-bottom: 15px;
            color: #4A4E69;
            border-bottom: 2px solid #9A8C98;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f1f1f1;
            color: #4A4E69;
        }

        .btn-delete {
    background-color: #e63946;
    color: white;
    padding: 5px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    width: 100px; /* Make all buttons the same width */
}

.btn-delete:hover {
    background-color: #d62828;
}

        form {
            margin-top: 20px;
        }

        form label {
            font-size: 14px;
            color: #4A4E69;
        }

        form input, form select, form textarea, form button {
            display: block;
            width: 100%;
            max-width: 400px;
            margin-top: 8px;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form textarea {
            resize: none;
        }

        form button {
            background-color: #457b9d;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #1d3557;
        }

        .add-section {
            margin-top: 30px;
        }

        .form-group h3 {
            color: #4A4E69;
        }

        .stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 15px;
    }

    .stat-card {
        flex: 1;
        background: #f4f4f4;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-card h3 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .stat-card p {
        font-size: 24px;
        font-weight: bold;
        color: #4F46E5;
    }
    </style>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <!-- Stats -->
    <div class="stats">
        <div class="stat-card">
            <h3>Total Teachers</h3>
            <p>{{ $teachersCount }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Courses</h3>
            <p>{{ $coursesCount }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Groups</h3>
            <p>{{ $groupsCount }}</p>
        </div>
    </div>
    
    <div class="container">
        <!-- Teachers Section -->
        <div class="dashboard-section">
            <h2>Manage Teachers</h2>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Weekly Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->first_name }}</td>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->type }}</td>
                        <td>{{ $teacher->weekly_hours }}</td>
                        <td class="button-container">
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            <div class="add-section">
                <h3>Add Teacher</h3>
                <form action="{{ route('teachers.store') }}" method="POST">
                    @csrf
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone">
                    <label for="type">Type</label>
                    <select id="type" name="type">
                        <option value="permanent">Permanent</option>
                        <option value="part-time">Part-Time</option>
                    </select>
                    <label for="weekly_hours">Weekly Hours</label>
                    <input type="number" id="weekly_hours" name="weekly_hours" required>
                    <button type="submit">Add Teacher</button>
                </form>
            </div>
        </div>

        <!-- Courses Section -->
        <div class="dashboard-section">
            <h2>Manage Courses</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th> 
                        <th>Course Name</th> 
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Teacher</th>
                        <th>Group</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->subject }}</td>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->date }}</td>
                        <td>{{ $course->type }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->teacher->first_name }} {{ $course->teacher->last_name }}</td>
                        <td>{{ $course->group->level }} {{ $course->group->name }}</td>
                        <td class="button-container">
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="add-section">
                <h3>Add Course</h3>
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                    <label for="course_name">Course Name</label>
                    <input type="text" id="course_name" name="course_name" required>
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                    <label for="type">Type</label>
                    <select id="type" name="type">
                            <option value="lesson">Lesson</option>
                            <option value="practice">Practice</option>
                    </select>
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                    <label for="teacher_id">Assign Teacher</label>
                    <select id="teacher_id" name="teacher_id" required>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                    </select>
                    <label for="group_id">Assign Group</label>
                    <select id="group_id" name="group_id" required>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->level }} {{ $group->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Add Course</button>
                </form>
            </div>
        </div>

        <!-- Groups Section -->
        <div class="dashboard-section">
            <h2>Manage Groups</h2>
            <table>
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Group Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->level }}</td>
                        <td>{{ $group->name }}</td>
                        <td class="button-container">
                            <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="add-section">
                <h3>Add Group</h3>
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <label for="level">Level</label>
                    <input type="text" id="level" name="level" required>
                    <label for="name">Group Name</label>
                    <input type="text" id="name" name="name" required>
                    <button type="submit">Add Group</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
