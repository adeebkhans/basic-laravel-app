@extends('layouts.app')

@section('content')
<div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header bg-white">
        <h4>Create New Task</h4>
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf <div class="mb-3"> {{-- Blade directive to include a hidden CSRF protection token for security --}}
                <label>Task Title *</label>
                <input type="text" name="title" class="form-control" placeholder="Enter task title" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Optional details..."></textarea>
            </div>

            <div class="mb-3">
                <label>Priority</label>
                <select name="priority" class="form-select">
                    <option value="Low">Low</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Task</button>
            </div>
        </form>
    </div>
</div>
@endsection