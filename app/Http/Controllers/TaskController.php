<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // show all tasks 
    public function index()
    {
        $tasks = Task::latest()->get();
        
        // Load the index view and pass the tasks to it
        return view('tasks.index', compact('tasks'));
    }

    // show the form to add a new task
    public function create()
    {
        return view('tasks.create');
    }

    // save the new task to the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'description' => 'nullable'
        ]);

        // Create the task
        Task::create($request->all());

        // Go back to the list with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // show the edit form 
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // update an existing task
    public function update(Request $request, Task $task)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required|in:Low,Medium,High',
            'description' => 'nullable'
        ]);

        // Update the task data
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            // Checkbox handling: if 'is_completed' is sent, set true, else false
            'is_completed' => $request->has('is_completed') 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // 6. DELETE A TASK
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}