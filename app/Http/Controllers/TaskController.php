<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(): Collection
    {
        return Task::with('column', 'user')->orderBy('position')->get();
    }

    public function show($id): Model|Collection|Task|null
    {
        return Task::with('column', 'user')->findOrFail($id);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'column_id' => 'required|exists:columns,id',
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'position' => 'required|integer',
        ]);

        $task = Task::create($data);
        return response()->json($task, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $task = Task::findOrFail($id);

        $data = $request->validate([
            'column_id' => 'required|exists:columns,id',
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'position' => 'required|integer',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    public function destroy($id): JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}

