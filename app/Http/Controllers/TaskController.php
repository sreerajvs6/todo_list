<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $dueDate = $request->input('due_date');

        $query = \App\Models\Task::with('category');

        if ($dueDate) {
            $query->whereDate('due_date', $dueDate);
        }

        $filter = $request->input('filter', 'all');
        if ($filter === 'active') {
            $query->where('completed', false);
        } elseif ($filter === 'completed') {
            $query->where('completed', true);
        }

        $total = $query->count();
        $tasks = $query->orderBy('created_at', 'desc')
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get()
            ->map(function ($task) {
                return [
                    'id' => $task->id,
                    'description' => $task->description,
                    'completed' => (bool)$task->completed,
                    'priority' => $task->priority,
                    'category_id' => $task->category_id,
                    'category_name' => optional($task->category)->name,
                    'category_color' => optional($task->category)->color,
                    'due_date' => $task->due_date,
                    'is_flagged' => (bool)$task->is_flagged,
                    'created_at' => $task->created_at,
                    'completed_at' => $task->completed_at,
                ];
            });

        $stats = [
            'total' => \App\Models\Task::count(),
            'completed' => \App\Models\Task::where('completed', true)->count(),
            'active' => \App\Models\Task::where('completed', false)->count(),
            'completed_dates' => \App\Models\Task::where('completed', true)
                ->whereNotNull('completed_at')
                ->distinct()
                ->selectRaw('DATE(completed_at) as date')
                ->orderBy('date', 'desc')
                ->pluck('date')
        ];

        return response()->json([
            'tasks' => $tasks,
            'total' => $total,
            'stats' => $stats
        ]);
    }

    public function store(Request $request)
    {
        $category = \App\Models\Category::where('name', $request->category)->first();
        
        \App\Models\Task::create([
            'id' => $request->id ?: (string)round(microtime(true) * 1000),
            'description' => $request->description,
            'completed' => $request->completed ? 1 : 0,
            'priority' => $request->priority,
            'category_id' => $category ? $category->id : null,
            'due_date' => $request->dueDate ? date('Y-m-d', strtotime($request->dueDate)) : null,
            'is_flagged' => $request->isFlagged ? 1 : 0,
            'created_at' => $request->createdAt ? date('Y-m-d H:i:s', strtotime($request->createdAt)) : now(),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $task = \App\Models\Task::findOrFail($id);
        $category = \App\Models\Category::where('name', $request->category)->first();

        $task->update([
            'description' => $request->input('description', $task->description),
            'completed' => $request->has('completed') ? ($request->completed ? 1 : 0) : $task->completed,
            'priority' => $request->input('priority', $task->priority),
            'category_id' => $category ? $category->id : $task->category_id,
            'due_date' => $request->has('dueDate') ? ($request->dueDate ? date('Y-m-d', strtotime($request->dueDate)) : null) : $task->due_date,
            'is_flagged' => $request->has('isFlagged') ? ($request->isFlagged ? 1 : 0) : $task->is_flagged,
            'completed_at' => $request->has('completedAt') ? ($request->completedAt ? date('Y-m-d H:i:s', strtotime($request->completedAt)) : null) : $task->completed_at,
        ]);

        return response()->json(['status' => 'success']);
    }

    public function destroy($id)
    {
        \App\Models\Task::destroy($id);
        return response()->json(['status' => 'success']);
    }

    public function completeAll()
    {
        \App\Models\Task::where('completed', false)->update([
            'completed' => true,
            'completed_at' => now()
        ]);
        return response()->json(['status' => 'success']);
    }

    public function clearCompleted()
    {
        \App\Models\Task::where('completed', true)->delete();
        return response()->json(['status' => 'success']);
    }
}
