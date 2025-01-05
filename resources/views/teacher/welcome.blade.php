@extends('layouts.app')

@section('content')
<div class="teacher-dashboard">
    <aside class="sidebar">
        <h3>Groups</h3>
        <ul>
            @foreach($groups as $group)
            <li>
                <a href="{{ route('teacher.courses', $group->id) }}">{{ $group->level }} {{ $group->name }}</a>
            </li>
            @endforeach
        </ul>
    </aside>

    <!-- Main Section -->
    <main class="main-content">
        <h2>Welcome, {{ auth()->user()->first_name }}</h2>

        <!-- Submitted Courses -->
        <section class="submitted-courses">
            <h3>Your Submitted Courses</h3>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Course Name</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
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
                        <td>{{ $course->group->level }} {{ $course->group->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Insert Course -->
        <section class="insert-course">
            <h3>Add a New Course</h3>
            <form action="{{ route('teacher.courses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" required>
                </div>

                <div class="form-group">
                    <label for="course_name">Course Name:</label>
                    <input type="text" name="course_name" id="course_name" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="type">Type:</label>
                    <input type="text" name="type" id="type" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="group_id">Group:</label>
                    <select name="group_id" id="group_id" required>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->level }} {{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-submit">Add Course</button>
            </form>
        </section>
    </main>
</div>
@endsection
