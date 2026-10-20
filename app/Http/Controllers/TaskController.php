<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'keyword' => ['nullable', 'string', 'max:150'],
            'status' => ['nullable', 'in:Pending,Completed'],
            'priority' => ['nullable', 'in:Low,Medium,High'],
        ]);

        $keyword = $filters['keyword'] ?? '';
        $status = $filters['status'] ?? '';
        $priority = $filters['priority'] ?? '';

        $query = $request->user()->tasks();

        if ($keyword !== '') {
            $query->where('title', 'ilike', '%' . $keyword . '%');
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        if ($priority !== '') {
            $query->where('priority', $priority);
        }

        $tasks = $query
            ->orderBy('due_date')
            ->orderByDesc('id')
            ->get();

        return view('tasks.index', compact(
            'tasks',
            'keyword',
            'status',
            'priority'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateTask($request);

        $request->user()->tasks()->create($data);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Request $request, string $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);

        $data = $this->validateTask($request);

        $task->update($data);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Request $request, string $task)
    {
        $task = $request->user()->tasks()->findOrFail($task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    private function validateTask(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'due_date' => ['required', 'date_format:Y-m-d'],
            'priority' => ['required', 'in:Low,Medium,High'],
            'status' => ['required', 'in:Pending,Completed'],
        ]);
    }
}
