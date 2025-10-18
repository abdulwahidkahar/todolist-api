<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return TodoResource::collection($todos)->additional(['message' => 'List of todos']);
    }

    public function store(StoreTodoRequest $request)
    {
        $userId = $request->user()->id;

        if (!$userId) {
            return response()->json([
                'message' => 'User not found'
            ]);
        }

        $validated = $request->validated();

        $validated['user_id'] = $userId;

        $todo = Todo::create($validated);

        return (new TodoResource($todo))->additional(['message' => 'Todo created successfully']);
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }

        $validated = $request->validated();

        $todo->update($validated);

        return (new TodoResource($todo))->additional(['message' => 'Todo updated successfully']);
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }

        $todo->delete();

        return (new TodoResource($todo))->additional(['message' => 'Todo deleted successfully']);
    }
}
