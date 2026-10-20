@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <div class="create-edit-container">
        <h1>Add New Task</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Task Title</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    maxlength="150"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>

                <select id="priority" name="priority" required>
                    @foreach (['Low', 'Medium', 'High'] as $value)
                        <option
                            value="{{ $value }}"
                            @selected(old('priority', 'Low') === $value)
                        >
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>

                <select id="status" name="status" required>
                    @foreach (['Pending', 'Completed'] as $value)
                        <option
                            value="{{ $value }}"
                            @selected(old('status', 'Pending') === $value)
                        >
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Add Task</button>

            <a href="{{ route('tasks.index') }}" class="cancel-link">
                Cancel
            </a>
        </form>
    </div>
@endsection
