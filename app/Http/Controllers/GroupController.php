<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Show a list of groups (READ)
    public function index()
    {
        $groups = Group::all(); // Fetch all groups
        return view('groups.index', compact('groups')); // Return a view with data
    }

    // Show the form to create a new group (CREATE)
    public function create()
    {
        return view('groups.create'); // Return a form for creating a new group
    }

    // Store the new group in the database (CREATE)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);

        Group::create($validated); // Store the validated data
        return redirect()->route('admin.dashboard'); // Redirect to the list of groups
    }

    // Show the form to edit a group (UPDATE)
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group')); // Return an edit form with group data
    }

    // Update a group's data in the database (UPDATE)
    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'level' => 'required|string|max:50',
        ]);

        $group->update($validated); // Update group data
        return redirect()->route('groups.index'); // Redirect to the list of groups
    }

    // Delete a group from the database (DELETE)
    public function destroy(Group $group)
    {
        $group->delete(); // Delete group
        return redirect()->route('groups.index'); // Redirect to the list of groups
    }
}
