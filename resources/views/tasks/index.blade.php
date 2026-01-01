@extends('layouts.app')

@section('content')

    {{-- Checks if there is a 'success' message stored in the session (flashed from a controller) --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>My Tasks</h3>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <strong>{{ $task->title }}</strong><br>
                                <small class="text-muted">{{ $task->description }}</small>
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ $task->priority == 'High' ? 'danger' : ($task->priority == 'Medium' ? 'warning' : 'info') }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $task->is_completed ? 'success' : 'secondary' }}">
                                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE') {{-- Method spoofing: Tells Laravel to treat this POST request as a DELETE request --}}
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($tasks->isEmpty())
                <p class="text-center mt-3">No tasks found. Click "Add New Task" to start!</p>
            @endif
        </div>
    </div>
@endsection