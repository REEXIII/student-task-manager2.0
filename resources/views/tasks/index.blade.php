@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
    @if (session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="GET"
          action="{{ route('tasks.index') }}"
          class="filters">

        <div>
            <label for="keyword">Search Task</label>

            <input
                type="text"
                id="keyword"
                name="keyword"
                value="{{ $keyword }}"
                placeholder="Search by title"
            >
        </div>

        <div>
            <label for="status">Status</label>

            <select id="status" name="status">
                <option value="">All</option>

                @foreach (['Pending', 'Completed'] as $value)
                    <option value="{{ $value }}"
                            @selected($status === $value)>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="priority">Priority</label>

            <select id="priority" name="priority">
                <option value="">All</option>

                @foreach (['Low', 'Medium', 'High'] as $value)
                    <option value="{{ $value }}"
                            @selected($priority === $value)>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">
            Search / Filter
        </button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>
                        <strong>{{ $task->title }}</strong>
                    </td>

                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->status }}</td>

                    <td>
                        <a class="edit-link"
                           href="{{ route('tasks.edit', $task) }}">
                            Edit
                        </a>

                        |

                        <form method="POST"
                              action="{{ route('tasks.destroy', $task) }}"
                              class="delete-form"
                              onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-link">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
