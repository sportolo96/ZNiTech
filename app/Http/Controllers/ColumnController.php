<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index(): Collection
    {
        return Column::with('tasks')->orderBy('position')->get();
    }

    public function show($id): Model|Collection|Column|null
    {
        return Column::with(['tasks' => function ($query) {
            $query->orderBy('position');
        }])->findOrFail($id);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|integer',
            'color' => 'nullable|string|max:7',
        ]);

        $column = Column::create($data);
        return response()->json($column, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $column = Column::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|integer',
            'color' => 'sometimes|string|max:7',
        ]);

        $column->update($data);

        return response()->json($column);
    }

    public function destroy($id): JsonResponse
    {
        $column = Column::findOrFail($id);
        $column->delete();

        return response()->json(null, 204);
    }
}
