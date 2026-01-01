@extends('layouts.app')

@section('content')
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4>Edit Task</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Task Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <select name="priority" class="form-select">
                        <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_completed" id="statusCheck" {{ $task->is_completed ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusCheck">
                        Mark as Completed
                    </label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection